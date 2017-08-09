describe 'Morris.Grid#setData', ->

  it 'should not alter user-supplied data', ->
    my_data = [{x: 1, y: 1}, {x: 2, y: 2}]
    expected_data = [{x: 1, y: 1}, {x: 2, y: 2}]
    Morris.Line
      element: 'graph'
      data: my_data
      xkey: 'x'
      ykeys: ['y']
      labels: ['dontcare']
    my_data.should.deep.equal expected_data

  describe 'ymin/ymax', ->
    beforeEach ->
      @defaults =
        element: 'graph'
        xkey: 'x'
        ykeys: ['y', 'z']
        labels: ['y', 'z']

    it 'should use a user-specified minimum and maximum value', ->
      line = Morris.Line $.extend @defaults,
        data: [{x: 1, y: 1}]
        ymin: 10
        ymax: 20
      line.ymin.should.equal 10
      line.ymax.should.equal 20

    describe 'auto', ->

      it 'should automatically calculate the minimum and maximum value', ->
        line = Morris.Line $.extend @defaults,
          data: [{x: 1, y: 10}, {x: 2, y: 15}, {x: 3, y: null}, {x: 4}]
          ymin: 'auto'
          ymax: 'auto'
        line.ymin.should.equal 10
        line.ymax.should.equal 15

      it 'should automatically calculate the minimum and maximum value given no y data', ->
        line = Morris.Line $.extend @defaults,
          data: [{x: 1}, {x: 2}, {x: 3}, {x: 4}]
          ymin: 'auto'
          ymax: 'auto'
        line.ymin.should.equal 0
        line.ymax.should.equal 1

    describe 'auto [n]', ->

      it 'should automatically calculate the minimum and maximum value', ->
        line = Morris.Line $.extend @defaults,
          data: [{x: 1, y: 10}, {x: 2, y: 15}, {x: 3, y: null}, {x: 4}]
          ymin: 'auto 11'
          ymax: 'auto 13'
        line.ymin.should.equal 10
        line.ymax.should.equal 15

      it 'should automatically calculate the minimum and maximum value given no data', ->
        line = Morris.Line $.extend @defaults,
          data: [{x: 1}, {x: 2}, {x: 3}, {x: 4}]
          ymin: 'auto 11'
          ymax: 'auto 13'
        line.ymin.should.equal 11
        line.ymax.should.equal 13

      it 'should use a user-specified minimum and maximum value', ->
        line = Morris.Line $.extend @defaults,
          data: [{x: 1, y: 10}, {x: 2, y: 15}, {x: 3, y: null}, {x: 4}]
          ymin: 'auto 5'
          ymax: 'auto 20'
        line.ymin.should.equal 5
        line.ymax.should.equal 20

      it 'should use a user-specified minimum and maximum value given no data', ->
        line = Morris.Line $.extend @defaults,
          data: [{x: 1}, {x: 2}, {x: 3}, {x: 4}]
          ymin: 'auto 5'
          ymax: 'auto 20'
        line.ymin.should.equal 5
        line.ymax.should.equal 20

  describe 'xmin/xmax', ->

    it 'should calculate the horizontal range', ->
      line = Morris.Line
        element: 'graph'
        data: [{x: 2, y: 2}, {x: 1, y: 1}, {x: 4, y: 4}, {x: 3, y: 3}]
        xkey: 'x'
        ykeys: ['y']
        labels: ['y']
      line.xmin.should == 1
      line.xmax.should == 4

    it "should pad the range if there's only one data point", ->
      line = Morris.Line
        element: 'graph'
        data: [{x: 2, y: 2}]
        xkey: 'x'
        ykeys: ['y']
        labels: ['y']
      line.xmin.should == 1
      line.xmax.should == 3

  describe 'sorting', ->

    it 'should sort data when parseTime is true', ->
      line = Morris.Line
        element: 'graph'
        data: [
          {x: '2012 Q1', y: 2},
          {x: '2012 Q3', y: 1},
          {x: '2012 Q4', y: 4},
          {x: '2012 Q2', y: 3}]
        xkey: 'x'
        ykeys: ['y']
        labels: ['y']
      line.data.map((row) -> row.label).should.deep.equal ['2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4']

    it 'should not sort data when parseTime is false', ->
      line = Morris.Line
        element: 'graph'
        data: [{x: 1, y: 2}, {x: 4, y: 1}, {x: 3, y: 4}, {x: 2, y: 3}]
        xkey: 'x'
        ykeys: ['y']
        labels: ['y']
        parseTime: false
      line.data.map((row) -> row.label).should.deep.e