var App = {
    init: function () {
        this.cacheElements();
        this.bindEvents(); 
    },
    cacheElements: function () {
        this.$play = $('button#play');
        this.$next = $('button#next');
        this.$stop = $('button#stop');
    },
    bindEvents: function () {
        $('table').on('click', 'td', App.cellClick);

        this.$next.click(App.nextClick)
    },
    cellClick: function () {
        $(this).toggleClass('active');
    },
    nextClick: function () {
        console.log('NEXT'); 
        App.getMatrix();
    },
    getMatrix: function () {
        var matrix = [];
        $('table#matrix tr').each(function (x) {
            matrix[x] = [];
            $(this).find('td').each(function (y) {
                matrix[x][y] = ($(this).hasClass('active')) ? 1 : 0;
            });
        }); 

        console.log(matrix); 
    }
};

$(document).ready(function () {
    App.init();
});
