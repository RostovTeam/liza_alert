
Share = {
    vkontakte: function(purl, ptitle, pimg, text) {
        url  = 'http://vkontakte.ru/share.php?';
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&image='       + encodeURIComponent(pimg);
        url += '&noparse=true';
        Share.popup(url);
    },
    odnoklassniki: function(purl, text) {
        url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
        url += '&st.comments=' + encodeURIComponent(text);
        url += '&st._surl='    + encodeURIComponent(purl);
        Share.popup(url);
    },
    facebook: function(purl, ptitle, pimg, text) {
        url  = 'http://www.facebook.com/sharer.php?s=100';
        url += '&p[title]='     + encodeURIComponent(ptitle);
        url += '&p[summary]='   + encodeURIComponent(text);
        url += '&p[url]='       + encodeURIComponent(purl);
        url += '&p[images][0]=' + encodeURIComponent(pimg);
        Share.popup(url);
    },
    twitter: function(purl, ptitle) {
        url  = 'http://twitter.com/share?';
        url += 'text='      + encodeURIComponent(ptitle);
        url += '&url='      + encodeURIComponent(purl);
        url += '&counturl=' + encodeURIComponent(purl);
        Share.popup(url);
    },
    mailru: function(purl, ptitle, pimg, text) {
        url  = 'http://connect.mail.ru/share?';
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&imageurl='    + encodeURIComponent(pimg);
        Share.popup(url)
    },

    popup: function(url) {
        window.open(url,'','toolbar=0,status=0,width=626,height=436');
    }
};


$('.share-buttons-panel a.facebook').bind('click', function() {
	var url = $('.share-buttons-panel').data('url'),
		title = $('.share-buttons-panel').data('title'),
		imgurl = $('.share-buttons-panel').data('imageurl300x300'),
		description = $('.share-buttons-panel').data('description');

	Share.facebook(url, title, imgurl, description);
});
$('.share-buttons-panel a.twitter').bind('click', function() {
	var url = $('.share-buttons-panel').data('url'),
		name = $('#lost_name').text(),
		city = $('#lost_city').text(),
		age = $('#lost_age').text();

	Share.twitter(url, 'Пропал человек! ' + name + ' ' + age + ' ' + city);
});
$('.share-buttons-panel a.odnoklassniki').bind('click', function() {
	var url = $('.share-buttons-panel').data('url'),
	title = $('.share-buttons-panel').data('title');

	Share.odnoklassniki(url, title);
});
$('.share-buttons-panel a.vkontakte').bind('click', function() {
	var url = $('.share-buttons-panel').data('url'),
		title = $('.share-buttons-panel').data('title'),
		imgurl = $('.share-buttons-panel').data('imageurl300x300'),
		description = $('.share-buttons-panel').data('description');

	Share.vkontakte(url, title, imgurl, description);
});
$('.share-buttons-panel a.mailru').bind('click', function() {
	var url = $('.share-buttons-panel').data('url'),
		title = $('.share-buttons-panel').data('title'),
		imgurl = $('.share-buttons-panel').data('imageurl300x300'),
		description = $('.share-buttons-panel').data('description');

	Share.mailru(url, title, imgurl, description);
});