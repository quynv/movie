var PageComingSoon = function () {

    return {
        
        //Coming Soon
        initPageComingSoon: function () {
			var newYear = new Date();
            var object = $('#defaultCountdown');
            var value = $(object).data('value');
            var date = value.split('-');
			newYear = new Date(parseInt(date[0]), parseInt(date['1']) - 1, parseInt(date['2']));
			$(object).countdown({until: newYear})
        }

    };
}();        