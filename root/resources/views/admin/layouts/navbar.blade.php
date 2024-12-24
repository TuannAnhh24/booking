<!-- navbar -->
<style>
    #notification-count {
        position: absolute;
        top: -2px;
        /* Điều chỉnh lại khoảng cách từ cạnh trên của button */
        right: -2px;
        /* Điều chỉnh lại khoảng cách từ cạnh phải của button */
        background-color: red;
        color: white;
        width: 16px;
        /* Kích thước của chấm đỏ */
        height: 16px;
        border-radius: 50%;
        /* Chuyển thành hình tròn */
        text-align: center;
        font-size: 10px;
        /* Kích thước chữ trong chấm đỏ */
        font-weight: bold;
        display: none;
        /* Ẩn chấm đỏ khi không có thông báo */
        z-index: 10;
        /* Đảm bảo chấm đỏ luôn nằm trên cùng */
    }
</style>
<div class="py-2 px-6 bg-[#f8f4f3] flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
    <button type="button" class="text-lg text-gray-900 font-semibold sidebar-toggle">
        <i class="ri-menu-line"></i>
    </button>

    <ul class="ml-auto flex items-center">
        <li class="mr-1 dropdown">
            <button type="button"
                class="dropdown-toggle text-gray-400 mr-4 w-8 h-8 rounded flex items-center justify-center  hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24"
                    style="fill: gray;transform: ;msFilter:;">
                    <path
                        d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z">
                    </path>
                </svg>
            </button>
            <div
                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                <form action="" class="p-4 border-b border-b-gray-100">
                    <div class="relative w-full">
                        <input type="text"
                            class="py-2 pr-4 pl-10 bg-gray-50 w-full outline-none border border-gray-100 rounded-md text-sm focus:border-blue-500"
                            placeholder="Search...">
                        <i class="ri-search-line absolute top-1/2 left-4 -translate-y-1/2 text-gray-900"></i>
                    </div>
                </form>
            </div>
        </li>
        <li class="dropdown">
            <button type="button"
                class="dropdown-toggle text-gray-400 mr-4 w-8 h-8 rounded flex items-center justify-center hover:text-gray-600 relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24" style="fill: gray;">
                    <path
                        d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z">
                    </path>
                </svg>
                <span id="notification-count"
                    class="absolute top-0 right-0 text-white bg-red-500 rounded-full text-xs w-4 h-4 flex items-center justify-center">0</span>
            </button>

            <div
                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                <div class="flex items-center px-4 pt-4 border-b border-b-gray-100 notification-tab">
                    <button type="button" data-tab="notification" data-tab-page="notifications"
                        class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1 active">Notifications</button>
                </div>
                <div class="my-2">
                    <ul class="max-h-64 overflow-y-auto" data-tab-for="notification" data-page="notifications">
                    </ul>
                    <ul class="max-h-64 overflow-y-auto hidden" data-tab-for="notification" data-page="messages">
                    </ul>
                </div>
            </div>
        </li>
        <button id="fullscreen-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="hover:bg-gray-100 rounded-full"
                viewBox="0 0 24 24" style="fill: gray;transform: ;msFilter:;">
                <path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"></path>
            </svg>
        </button>
        <script>
            const fullscreenButton = document.getElementById('fullscreen-button');

            fullscreenButton.addEventListener('click', toggleFullscreen);

            function toggleFullscreen() {
                if (document.fullscreenElement) {
                    // If already in fullscreen, exit fullscreen
                    document.exitFullscreen();
                } else {
                    // If not in fullscreen, request fullscreen
                    document.documentElement.requestFullscreen();
                }
            }
        </script>

        <li class="dropdown ml-3">
            <button type="button" class="dropdown-toggle flex items-center">
                <div class="flex-shrink-0 w-10 h-10 relative">
                    <div class="p-1 bg-white rounded-full focus:outline-none focus:ring">
                        <img class="w-8 h-8 rounded-full"
                            src="{{ !Auth::user()->avatar || empty(Auth::user()->avatar)
                                ? asset('image/avatar_default.png')
                                : (str_starts_with(Auth::user()->avatar, 'image/')
                                    ? asset(Auth::user()->avatar)
                                    : asset('storage/' . Auth::user()->avatar)) }}"
                            alt="" />
                        <div
                            class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping">
                        </div>
                        <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full">
                        </div>
                    </div>
                </div>
                <div class="p-2 md:block text-left">
                    <h2 class="text-sm font-semibold text-gray-800">{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }}</h2>
                    <p class="text-xs text-gray-500">{{ Auth::user()->role->name }}</p>
                </div>
            </button>
            <ul
                class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                <li>
                    <a href="{{ route('users.showProfile') }}"
                        class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">{{ __('content.navbar.profile') }}</a>
                </li>
                <li>
                    <form method="GET" action="{{ route('logout') }}">
                        <a role="menuitem"
                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50 cursor-pointer"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('content.navbar.logout') }}
                        </a>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</div>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    // Khởi tạo Pusher với cấu hình nhận từ backend
    fetch('/pusher-config')
        .then(response => response.json())
        .then(config => {
            // Khởi tạo Pusher sau khi nhận cấu hình
            const pusher = new Pusher(config.key, {
                cluster: config.cluster,
                useTLS: config.useTLS,
            });

            // Lấy userId từ Laravel's auth system
            const userId = @json(auth()->id());
            const channel = pusher.subscribe('user-' + userId);

            // Lắng nghe sự kiện 'booking' trên channel
            channel.bind('booking', handleBookingNotification);

            // Hàm xử lý thông báo 'booking'
            function handleBookingNotification(data) {
                const { message, full_name, created_at } = data.message;
                const timeAgoString = timeAgo(created_at);

                // Tạo thông báo mới
                const notificationList = document.querySelector('[data-tab-for="notification"]');
                const newNotification = createNotificationElement(message, full_name, timeAgoString);

                // Thêm vào đầu danh sách
                notificationList.insertBefore(newNotification, notificationList.firstChild);

                // Cập nhật số lượng thông báo chưa đọc
                unreadNotificationsCount++;
                updateNotificationCount();
            }
        })
        .catch(error => console.error('Error fetching Pusher config:', error));

    // Hàm lấy thông báo từ cơ sở dữ liệu
    function getNotifications() {
        fetch('/admin/get-notifications')
            .then(response => response.json())
            .then(data => {
                const notificationList = document.querySelector('[data-tab-for="notification"]');
                data.notifications.forEach(notification => {
                    const timeAgoString = timeAgo(notification.created_at);
                    const newNotification = createNotificationElement(notification.message, notification.full_name, timeAgoString);
                    notificationList.appendChild(newNotification);
                });
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Hàm tạo phần tử thông báo
    function createNotificationElement(message, fullName, timeAgoString) {
        const newNotification = document.createElement('li');
        newNotification.innerHTML = `
            <a href="{{ route('admin.manage.manageBooking') }}" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                <div class="ml-2">
                    <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">
                        ${message}
                    </div>
                    <div class="text-[11px] text-gray-400">${fullName} • ${timeAgoString}</div>
                </div>
            </a>
        `;
        return newNotification;
    }

    // Hàm cập nhật số lượng thông báo chưa đọc
    function updateNotificationCount() {
        const notificationCountElement = document.getElementById('notification-count');
        if (unreadNotificationsCount > 0) {
            notificationCountElement.textContent = unreadNotificationsCount;
            notificationCountElement.style.display = 'flex'; // Hiển thị chấm đỏ
        } else {
            notificationCountElement.style.display = 'none'; // Ẩn chấm đỏ khi không có thông báo
        }
    }

    // Hàm để lấy khoảng thời gian dễ đọc
    function timeAgo(dateString) {
        const now = new Date();
        const date = new Date(dateString);
        const diffInSeconds = Math.floor((now - date) / 1000);
        const diffInMinutes = Math.floor(diffInSeconds / 60);
        const diffInHours = Math.floor(diffInMinutes / 60);
        const diffInDays = Math.floor(diffInHours / 24);

        if (diffInMinutes < 1) return '{{ __('content.notifications.now') }}'; // Less than a minute ago
        if (diffInMinutes < 60) return `${diffInMinutes} {{ __('content.notifications.minutes_ago') }}`;
        if (diffInHours < 24) return `${diffInHours} {{ __('content.notifications.hours_ago') }}`;
        if (diffInDays < 30) return `${diffInDays} {{ __('content.notifications.days_ago') }}`;
        return date.toLocaleDateString(); // Return the full date if it's more than a month
    }

    // Hàm khởi tạo khi tải trang
    let unreadNotificationsCount = 0; // Biến lưu số lượng thông báo chưa đọc
    getNotifications(); // Gọi để lấy thông báo khi tải trang
</script>

<!-- end navbar -->
