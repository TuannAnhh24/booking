
<body>
    <style>
        .hidden {
            display: none;
        }

        .show {
            display: block;
        }

        #dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            width: 12rem;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            z-index: 10;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            opacity: 0;
            visibility: hidden;
        }

        #dropdown-menu.show {
            opacity: 1;
            visibility: visible;
        }

        //
        #notification-dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            width: 12rem;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            z-index: 10;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            opacity: 0;
            visibility: hidden;
        }

        #notification-dropdown.show {
            opacity: 1;
            visibility: visible;
        }

        /* Ẩn modal mặc định */
        .focus-child {
            display: none;
        }

        /* Hiển thị modal khi focus vào button hoặc phần tử bên trong focus-parent */
        .focus-parent:focus-within .focus-child {
            display: block;
        }
    </style>
    <header class="bg-[#003b95]">
        <div class="w-[1024px] mx-auto max-w-full">
            <div class="h-[108px]">
                <div class="relative">
                    @include('client.layouts.header')
                    {{-- NavSearch --}}
                    @include('client.searchresults.layouts-search.search')
                </div>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/@material-tailwind/html@latest/scripts/ripple.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@material-tailwind/html@latest/scripts/dialog.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/material-tailwind@latest/material-tailwind.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
    <script>
        const btnParentFocus = document.querySelectorAll(".focus-parent");
        const btnChildFocus = document.querySelectorAll(".focus-child");
        const btnCancel = document.querySelector(".btn-cancel");

        function hide() {
            btnChildFocus.forEach((child) => {
                child.classList.remove("open");
            });
        }

        btnParentFocus.forEach((btn, index) => {
            const child = btnChildFocus[index];
            btn.addEventListener("click", (e) => {
                e.stopPropagation();
                hide();
                child.classList.toggle("open");
            });
        });

        btnCancel.addEventListener("click", function(event) {
            event.stopPropagation(); 
            hide();
        });

        document.addEventListener("click", function(event) {
            event.stopPropagation();
            hide();
        });
    </script>
    <script>
        function app() {
            return {
                chartData: [10, 50, 20, 40, 25, 35, 60, 65, 15, 10, 50, 20, 40, 25, 35, 60, 65, 15, 25, 35, 60, 65, 15, 50,
                    20, 40, 25, 35, 60, 50, 20, 40, 25, 35, 60, 40, 25, 35, 60, 50, 20, 40, 25, 35, 60,
                ],
                tooltipContent: '',
                tooltipOpen: false,
                tooltipX: 0,
                tooltipY: 0,
                showTooltip(e) {
                    console.log(e);
                    this.tooltipContent = e.target.textContent
                    this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
                    this.tooltipY = e.target.clientHeight + e.target.clientWidth;
                },
                hideTooltip(e) {
                    this.tooltipContent = '';
                    this.tooltipOpen = false;
                    this.tooltipX = 0;
                    this.tooltipY = 0;
                }
            }
        }
    </script>
    <script>
        flatpickr("#start-date", {
            plugins: [new rangePlugin({
                input: "#end-date"
            })], 
            dateFormat: "Y-m-d",
            minDate: "today", 
            locale: {
                firstDayOfWeek: 1
            }
        });
    </script>
</body>

</html>
