var App = {
    interval: null,
    init: function () {
        this.cacheElements();
        this.bindEvents();
    },
    cacheElements: function () {
        this.$play = $('button#play');
        this.$next = $('button#next');
        this.$stop = $('button#stop');
        this.$clear = $('button#clear');
        this.$save = $('button#save');
        this.$setSize = $('button#setSize');
        this.$width = $('input#width');
        this.$height = $('input#height');
    },
    bindEvents: function () {
        $('table').on('click', 'td', App.cellClick);

        this.$next.click(App.nextClick);
        this.$clear.click(App.clearMatrix);
        this.$play.click(App.playClick);
        this.$stop.click(App.stopClick);
        this.$save.click(App.saveClick);
        this.$setSize.click(App.setSizeClick);
    },
    setSizeClick: function () {
        var newWidth = App.$width.val();
        var newHeight = App.$height.val();
        var currentMatrix = App.getMatrix();
        var append = '';

        for (var x = 0; x < newWidth; x++) {
            append += '<tr>';
            for (var y = 0; y < newHeight; y++) {
                append += '<td></td>'; 
            }

            append += '</tr>';
        } 

        $('table#matrix').html(append);
        App.fillMatrix(currentMatrix);
    },
    saveClick: function () {
        $.ajax({
            url: '/api/generation/save',
            type: 'POST',
            dataType: 'json',
            data: {
                name: $('input#name').val(),
                matrix: JSON.stringify(App.getMatrix())
            },
            success: function (data) {
                $('input#name').val('');
                console.log('Successful save'); 
            }
        });
    },
    cellClick: function () {
        $(this).toggleClass('active');
    },
    nextClick: function () {
        // Itt valoszinuleg hash -t kellene generalni az ertekekbol, igy lehetne GET keres, sajnos nem volt ra idom
        $.ajax({
            url: '/api/generation/next',
            type: 'POST',
            dataType: 'json',
            data: {
                matrix: JSON.stringify(App.getMatrix())
            },
            success: function (nextGeneration) {
                App.fillMatrix(nextGeneration);
            }
        });
    },
    playClick: function () {
        var matrix = App.getMatrix();
        var time = 1000;
        var length = Math.max(matrix.length, matrix[0].length);

        if (length > 50 && length < 100) {
            time = 3000;
        }

        if (length >= 100) 
            time = 5000;

        App.interval = setInterval(App.nextClick, time);
    },
    stopClick: function () {
        clearInterval(App.interval);
    },
    getMatrix: function () {
        var matrix = [];
        $('table#matrix tr').each(function (x) {
            matrix[x] = [];
            $(this).find('td').each(function (y) {
                matrix[x][y] = ($(this).hasClass('active')) ? 1 : 0;
            });
        }); 

        return matrix;
    },
    fillMatrix: function (nextGeneration) {
        $('table#matrix tr').each(function (x) {
            $(this).find('td').each(function (y) {
                if (nextGeneration[x] != undefined && nextGeneration[x][y] != undefined && nextGeneration[x][y] == 1) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
        }); 
    },
    clearMatrix: function () {
        $('table#matrix td').removeClass('active');
    }
};

$(document).ready(function () {
    App.init();
});
