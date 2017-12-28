<?php

namespace App\Http\Controllers\Veritrans;
use App\Http\Controllers\Controller;
use App\invoice;
use App\members;
use App\packages;
use App\Veritrans\Veritrans;
use DateTime;
use DB;
use Session;
use Mail;
use App\Mail\InvoiceMail;
use App\Mail\SuksesMail;


class VtwebController extends Controller {
	public function __construct() {
		Veritrans::$serverKey = 'VT-server-_cXc9tYjPxt4JEX7B7qDSQP_';

		//set Veritrans::$isProduction  value to true for production mode
		Veritrans::$isProduction = true;
	}

	public function vtweb() {
		$members = members::where('id', '=', Session::get('memberID'))->first();
		$packages = packages::where('id', '=', Session::get('packageID'))->first();
		$invoice = invoice::where('code', '=', Session::get('invoiceCODE'))->first();

		if ($members == null || $members == null || $invoice == null) {
			die('Anda belum memilih paket langganan Cilsy !');
		}

		$vt = new Veritrans;

		$transaction_details = array(
			'order_id' => $invoice->code,
			'gross_amount' => $invoice->price,
		);

		// Populate items
		$items = [
			array(
				'id' => $invoice->code,
				'price' => $invoice->price,
				'quantity' => 1,
				'name' => "Pemesanan Paket Cilsy",
			),
		];


		// Populate customer's Info
		$customer_details = array(
			'first_name' => $members->username,
			'email' => $members->email,
		);

		// Data yang akan dikirim untuk request redirect_url.
		// Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
		$transaction_data = array(
			'payment_type' => 'vtweb',
			'vtweb' => array(
				//'enabled_payments'    => [],
				'credit_card_3d_secure' => true,
			),
			'transaction_details' => $transaction_details,
			'item_details' => $items,
			'customer_details' => $customer_details,
		);

		try
		{
			$vtweb_url = $vt->vtweb_charge($transaction_data);
			return redirect($vtweb_url);
		} catch (Exception $e) {
			return $e->getMessage;
		}
	}

	public function notification() {

		$vt = new Veritrans;
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);
		if ($result) {
			$notif = $vt->status($result->order_id);

			$transaction = $notif->transaction_status;
			$type = $notif->payment_type;
			$order_id = $notif->order_id;
			$fraud = $notif->fraud_status;

			if ($transaction == 'capture') {
				// For credit card transaction, we need to check whether transaction is challenge by FDS or not
				if ($type == 'credit_card') {
					if ($fraud == 'challenge') {
						// TODO set payment status in merchant's database to 'Challenge by FDS'
						// TODO merchant should decide whether this transaction is authorized or not in MAP
						DB::table('invoice')->where('code', '=', $order_id)->update([
							'status' => 3,
							'type' => $type,
							'notes' => "Transaction order_id: " . $order_id . " is challenged by FDS",
						]);
					} else {
						// TODO set payment status in merchant's database to 'Success'
						// Update status Invoices
						DB::table('invoice')->where('code', '=', $order_id)->update([
							'status' => 1,
							'type' => $type,
							'notes' => "Transaction order_id: " . $order_id . " successfully captured using " . $type,
						]);
						// Create New Services
						$this->create_services($order_id);
						$member = DB::table('invoice')->where('members_id', '=', $order_id)->first();
						$send = members::findOrFail($member->id);
						Mail::to($member->email)->send(new SuksesMail($send));

					}
				}
			} else if ($transaction == 'settlement') {
				// TODO set payment status in merchant's database to 'Settlement'
				$invoice = DB::table('invoice')->where('code', '=', $order_id)->update([
					'status' => 1,
					'type' => $type,
					'notes' => "Transaction order_id: " . $order_id . " successfully transfered using " . $type,
				]);
				// Create New Services
				$send = members::findOrFail($members->id);
				Mail::to($members->email)->send(new SuksesMail($send));
				$this->create_services($order_id);
			} else if ($transaction == 'pending') {
				$send = members::findOrFail($member->id);
				Mail::to($member->email)->send(new InvoiceMail($send));
				// TODO set payment status in merchant's database to 'Pending'
				DB::table('invoice')->where('code', '=', $order_id)->update([
					'status' => 2,
					'type' => $type,
					'notes' => "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type,
				]);
				
			} else if ($transaction == 'deny') {
				// TODO set payment status in merchant's database to 'Denied'
				DB::table('invoice')->where('code', '=', $order_id)->update([
					'status' => 4,
					'type' => $type,
					'notes' => "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.",
				]);

			}

		}
		error_log(print_r($result, TRUE));

	}


	private function create_services($order_id) {
		// echo "create new services";
		# If invoice status completed

		$now = new DateTime();

		// Getting Invoice & package
		$invoice = DB::table('invoice')->where('code', '=', $order_id)->first();
		$packages = DB::table('packages')->where('id', '=', $invoice->packages_id)->first();

		// $packages = DB::table('packages')->where('$invoice','=',$invoice)
		if (count($invoice) > 0 && count($packages) > 0) {

			// Check services if exist
			$check = DB::table('services')
				->leftJoin('invoice', 'services.members_id', '=', 'invoice.members_id')
				->where('services.members_id', '=', $invoice->members_id)
				->where('services.status', '=', 1)
				->first();
			if (count($check) > 0) {

				DB::table('services')
					->where('members_id', '=', $invoice->members_id)
					->update([
						'status' => 2, //Expired
					]);

				echo $invoice->packages_id;
				echo $check->packages_id;

				if ($invoice->packages_id == $check->packages_id) {
					$datetime1 = $now;
					$datetime2 = new DateTime($check->expired);
					$difference = $datetime1->diff($datetime2);
					$day = $difference->days + $packages->expired;

					$start = date('Y-m-d');
					$expired = date('Y-m-d', strtotime(' + ' . $day . ' days'));
					echo "Ready Package";
				} else {
					$start = date('Y-m-d');
					$expired = date('Y-m-d', strtotime(' + ' . $packages->expired . ' days'));
					echo "New Package";
				}

			} else {
				$start = date('Y-m-d');
				$expired = date('Y-m-d', strtotime(' + ' . $packages->expired . ' days'));
			}

			// Create new Services
			DB::table('services')->insert([
				'status' => 1, // 1 = Active
				'members_id' => $invoice->members_id,
				'invoice_id' => $invoice->code,
				'title' => $packages->title,
				'price' => $packages->price,
				'start' => $start,
				'expired' => $expired,
				'access' => $packages->access,
				'update' => $packages->update,
				'chat' => $packages->chat,
				'download' => $packages->download,
				'created_at' => $now,
				'updated_at' => $now,
			]);

			echo "Services successfully added";
		}
	}
}
