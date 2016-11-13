//chart.js
/**
 * Defines a class useful for making point and line graph charts.
 *
 * Example use:
 * graph = new Chart(some_html_element_id, 
 *     {"Jan":7, "Feb":20, "Dec":5}, {"title":"Test Chart - Month v Value"});
 * graph.draw();
 *
 * @param String chart_id id of tag that the chart will be drawn into
 * @param Object data a sequence {x_1:y_1, ... x_1,y_n} points to plot
 *    x_i's can be arbitrary labels, y_i's are assumes to be floats
 * @param Object (optional) properties override values for any of the
 *      properties listed in the property_defaults variable below
 */

 function Chart(chart_id, data)
 {
    var self = this;
    var p = Chart.prototype;
    var properties = (typeof arguments[2] !== 'undefined') ?
    arguments[2] : {};
    var container = document.getElementById(chart_id);
    if (!container) {
        return false;
    }
    var property_defaults = {
        'axes_color' : 'rgb(128,128,128)', // color of the x and y axes lines
        'caption' : '', // caption text appears at bottom
        'caption_style' : 'font-size: 14pt; text-align: center;',
            // CSS styles to apply to caption text
        'data_color' : 'rgb(0,0,255)', //color used to draw grah
        'height' : 500, //height of area to draw into in pixels
        'line_width' : 1, // width of line in line graph
        'x_padding' : 30, //x-distance left side of canvas tag to y-axis
        'y_padding' : 30, //y-distance bottom of canvas tag to x-axis
        'point_radius' : 3, //radius of points that are plot in point graph
        'tick_length' : 10, // length of tick marks along axes
        'ticks_y' : 5, // number of tick marks to use for the y axis
        'tick_font_size' : 10, //size of font to use when labeling ticks
        'title' : '', // title text appears at top
        'title_style' : 'font-size:24pt; text-align: center;',
            // CSS styles to apply to title text
        'type' : 'LineGraph', // currently, can be either a LineGraph or
            //PointGraph
        'width' : 500 //width of area to draw into in pixels
    };
    for (var property_key in property_defaults) {
        if (typeof properties[property_key] !== 'undefined') {
            this[property_key] = properties[property_key];
        } else {
            this[property_key] = property_defaults[property_key];
        }
    }
    title_tag = (this.title) ? '<div style="' + this.title_style
    + 'width:' + this.width + '" >' + this.title + '</div>' : '';
    caption_tag = (this.caption) ? '<figcaption style="' + this.caption_style
    + 'width:' + this.width + '" >' + this.caption + '</figcaption>' : '';
    container.innerHTML = '<figure>'+ title_tag + '<canvas id="' + chart_id +
    '-content" ></canvas>' + caption_tag + '</figure>';
    canvas = document.getElementById(chart_id + '-content');
    if (!canvas || typeof canvas.getContext === 'undefined') {
        return
    }
    var context = canvas.getContext("2d");
    canvas.width = this.width;
    canvas.height = this.height;
    this.data = data;
    /**
     * Main function used to draw the graph type selected
     */
     p.draw = function()
     {
        // move these here, so they run only once
        self.initMinMaxRange();
        self.renderAxes();
        
        // call draw function
        self['draw' + self.type]();
    }
    /**
     * Used to store in fields the min and max y values as well as the start
     * and end x keys, and the range = max_y - min_y
     */
     p.initMinMaxRange = function()
     {
        self.min_value = null;
        self.max_value = null;
        self.series_count = null;
        self.start;
        self.end;
        var key;
        for (key in data) {
            for (var i = 0; i < data[key].length; i++) {
                if (self.series_count == null || i + 1 > self.series_count) {
                    // how many data series do we have?
                    self.series_count = i + 1;
                }
                if (!isNaN(data[key][i])) {
                    data[key][i] = parseFloat(data[key][i]);
                    if (self.min_value === null) {
                        self.min_value = data[key][i];
                        self.max_value = data[key][i];
                        self.start = key;
                    }
                    if (data[key][i] < self.min_value) {
                        self.min_value = data[key][i];
                    }
                    if (data[key][i] > self.max_value) {
                        self.max_value = data[key][i];
                    }
                }
            }
        }
        self.end = key;
        console.log(self.min_value, self.max_value, self.start, self.end);
        self.range = self.max_value - self.min_value;
    }
    /**
     * Used to draw a point at location x,y in the canvas
     */
     p.plotPoint = function(x,y)
     {
        var c = context;
        c.beginPath();
        c.arc(x, y, self.point_radius, 0, 2 * Math.PI, true);
        c.fill();
    }
    /**
     * Draws the x and y axes for the chart as well as ticks marks and values
     */
     p.renderAxes = function()
     {
        var c = context;
        var height = self.height - self.y_padding;
        c.strokeStyle = self.axes_color;
        c.lineWidth = self.line_width;
        c.beginPath();
        c.moveTo(self.x_padding - self.tick_length,
            self.height - self.y_padding);
        c.lineTo(self.width - self.x_padding,  height);  // x axis
        c.stroke();
        c.beginPath();
        c.moveTo(self.x_padding, self.tick_length);
        c.lineTo(self.x_padding, self.height - self.y_padding +
            self.tick_length);  // y axis
        c.stroke();
        var spacing_y = self.range/self.ticks_y;
        height -= self.tick_length;
        var min_y = parseFloat(self.min_value);
        var max_y = parseFloat(self.max_value);
        var num_format = new Intl.NumberFormat("en-US",
            {"maximumFractionDigits":2});
        // Draw y ticks and values
        for (var val = min_y; val < max_y + spacing_y; val += spacing_y) {
            y = self.tick_length + height * 
            (1 - (val - self.min_value)/self.range);
            c.font = self.tick_font_size + "px serif";
            c.fillText(num_format.format(val), 0, y + self.tick_font_size/2,
                self.x_padding - self.tick_length);
            c.beginPath();
            c.moveTo(self.x_padding - self.tick_length, y);
            c.lineTo(self.x_padding, y);
            c.stroke();
        }
        // Draw x ticks and values
        var dx = (self.width - 2 * self.x_padding) /
        (Object.keys(data).length - 1);
        var x = self.x_padding;
        for (key in data) {
            c.font = self.tick_font_size + "px serif";
            c.fillText(key, x - self.tick_font_size/2 * (key.length - 0.5), 
                self.height - self.y_padding +  self.tick_length +
                self.tick_font_size, self.tick_font_size * (key.length - 0.5));
            c.beginPath();
            c.moveTo(x, self.height - self.y_padding + self.tick_length);
            c.lineTo(x, self.height - self.y_padding);
            c.stroke();
            x += dx;
        }
    }
    
    p.plotLine = function(x, y, x2, y2) {
        var c = context;
        c.beginPath();
        c.lineWidth = 5;
        c.moveTo(x, y);
        c.lineTo(x2, y2);
        c.stroke();
    }
    
    /**
     * 
     * Draws a histogram
     * based on drawPointGraph
     */
    p.drawHistogram = function() 
    {
        var dx = (self.width - 2*self.x_padding) /
        (Object.keys(data).length - 1);
        var c = context;
        c.lineWidth = self.line_width;
        c.strokeStyle = self.data_color;
        c.fillStyle = self.data_color;
        var height = self.height - self.y_padding - self.tick_length;
        var x = self.x_padding;
        // this is the bottom of the chart:
        var ground = self.tick_length + height;
        for (var key in data) {
            for (var i = 0; i < data[key].length; i++) {
                var y = self.tick_length + height *
                    (1 - (data[key][i] - self.min_value)/self.range);
                // draw line from ground to y value
                // offset x with 2.5 (half of line width)
                // + 7.5 * data series id -> data series won't overlap
                self.plotLine(x + 2.5 + 7.5 * i, ground, x + 2.5 + 7.5 * i, y);
            }
            x += dx;
        }
    }
    
    /**
     * Draws a chart consisting of just x-y plots of points in data.
     */
     p.drawPointGraph = function()
     {
        var dx = (self.width - 2*self.x_padding) /
        (Object.keys(data).length - 1);
        var c = context;
        c.lineWidth = self.line_width;
        c.strokeStyle = self.data_color;
        c.fillStyle = self.data_color;
        var height = self.height - self.y_padding - self.tick_length;
        var x = self.x_padding;
        for (key in data) {
            for(var i = 0; i < data[key].length; i++) {
                if(data[key][i] == null) continue;
                y = self.tick_length + height *
                    (1 - (data[key][i] - self.min_value)/self.range);
                console.log("plot", key, i, x, y);
                self.plotPoint(x, y);
            }
            x += dx;
        }
    }
    /**
     * Draws a chart consisting of x-y plots of points in data, each adjacent
     * point pairs connected by a line segment
     */
     p.drawLineGraph = function()
     {
        self.drawPointGraph();
        var c = context;
        var x = self.x_padding;
        var dx = (self.width - 2*self.x_padding) /
            (Object.keys(data).length - 1);
        var height = self.height - self.y_padding  - self.tick_length;
        for (var i = 0; i < self.series_count; i++) {
            x = self.x_padding;
            console.log("plot", i, "series");
            c.moveTo(x, self.tick_length + height * (1 -
                (data[self.start][i] - self.min_value)/self.range));
            c.beginPath();
            for (key in data) {
                y = self.tick_length + height * 
                    (1 - (data[key][i] - self.min_value)/self.range);
                c.lineTo(x, y);
                console.log(x,y);
                x += dx;
            }
            c.stroke();
        }
    }
}