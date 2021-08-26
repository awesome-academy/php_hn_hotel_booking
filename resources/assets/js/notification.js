var notificationsWrapper   = $('.order-notification');
var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsToggle.find('span[data-count]');
var notificationsCount     = parseInt(notificationsCountElem.data('count'));
var notifications          = notificationsWrapper.find('.notification');
var  translator = new I18n;

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher(window.PUSHER_APP_KEY, {
    cluster: window.PUSHER_APP_CLUSTER,
    encrypted: true
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('Notify');

// Bind a function to a Event (the full Laravel class)
channel.bind('send-message', function(data) {
    var existingNotifications = notifications.html();
    var newNotificationHtml = `
        <div class="dropdown-divider"></div>
        <a href="${ data.route }" class="dropdown-item active">
            <i class="fas fa-envelope mr-2"></i>
            <b>${ data.title }</b>
            <p>${ data.content }
                <span class="float-right text-muted text-sm">${ data.created_at }</span>
            </p>
        </a>
    `;
    notifications.html(newNotificationHtml + existingNotifications);
    notificationsCount += 1;
    notificationsCountElem.attr('data-count', notificationsCount);
    notificationsWrapper.find('.notify-count-number').text(notificationsCount)
    notificationsWrapper.find('.notify-count').text(notificationsCount + ` ${ translator.trans('partner.messages')}`);
    notificationsWrapper.show();
});
