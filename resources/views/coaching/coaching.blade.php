<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova - Coaching Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
</head>
<body class="bg-gradient-to-br from-purple-50 via-white to-blue-50 min-h-screen font-sans">
    <!-- Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success fixed top-5 z-[1111111111] right-5 bg-green-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger fixed top-5 z-50 right-5 bg-red-600 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('error') }}
    </div>
    @endif

    @if(session('warning'))
    <div class="alert alert-warning fixed top-5 z-50 right-5 bg-yellow-500 text-white py-2 px-4 rounded-md shadow-lg opacity-0 translate-x-full transition-all duration-500">
        {{ session('warning') }}
    </div>
    @endif

    <!-- Navbar -->
    @if (Route::has('login'))
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-2xl font-extrabold text-indigo-600">Learnova</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button id="class" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center" onclick="openModal('classmodal')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Create Class
                    </button>
                    <button id="course" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center" onclick="openModal('coursemodal')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Create Course
                    </button>
                    <button id="Lesson" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center" onclick="openModal('lessonsmodal')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Create Lesson
                    </button>
                    <div class="relative inline-block text-left">
                        <button class="inline-flex items-center justify-center rounded-full px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500" onclick="toggleDropdown()" id="menu-button" aria-expanded="false" aria-haspopup="true">
                            <span>{{ Auth::user()->name }}</span>
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="w-8 h-8 rounded-full ml-2 border-2 border-indigo-200">
                        </button>
                        <div id="dropdown-menu" class="hidden absolute right-0 z-10 mt-2 w-48 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Profile</a>
                                <a href="{{ url('/calendar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Courses</a>
                                @if (Auth::user() && Auth::user()->hasRole(['coach']))
                                <a href="{{ url('/coaching') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Coaching</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endif

    <!-- Welcome Section -->
    <section class="pt-32 pb-20 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-6">Welcome to your coaching profile</h1>
            <p class="text-xl text-gray-600 mb-12">Manage your classes, courses, and schedule all in one place</p>
        </div>
    </section>

    <!-- Classes Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">My Classes</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($classes as $class)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-indigo-600">{{ $class->name }}</h4>
                        <p class="mt-2 text-gray-600">{{ Str::limit($class->description, 100) }}</p>
                        <div class="mt-6 flex justify-center">
                            <a href="classe/{{ $class->id }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                View Class
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Calendar Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h3 class="text-3xl font-bold text-gray-900">Schedule Overview</h3>
                <p class="mt-4 text-gray-600">Manage your classes and courses schedule</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6" id="calendar"></div>
        </div>
    </section>

    <!-- Hidden Update Form -->
    <form class="hidden" id="updateForm" method="post" action="">
        @csrf @method('PUT')
        <input id="updatedStart" name="start" type="hidden">
        <input id="updatedEnd" name="end" type="hidden">
        <button id="submitUpdate"></button>
    </form>

    <!-- Include other components -->
    @include('components.delete_event')
    @include('components.create_classe')
    @include('components.create_courses')
    @include('components.create_lessons')

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-indigo-600 mb-4">Learnova</h1>
                <p class="text-gray-600">&copy; 2024 Learnova. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Your existing JavaScript code remains the same
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.classList.toggle('hidden');
        }

        window.openModal = function(modalId) {
            document.getElementById(modalId).style.display = 'block';
            document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden');
        }

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden');
        }

        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode === 27) {
                document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden');
                let modals = document.getElementsByClassName('modal');
                Array.prototype.slice.call(modals).forEach(i => {
                    i.style.display = 'none';
                });
            }
        };

        // document.addEventListener('DOMContentLoaded', async function() {
        //     let response = await axios.get("/calendar/create");
        //     let events = response.data.events;

        //     var myCalendar = document.getElementById('calendar');
        //     var calendar = new FullCalendar.Calendar(myCalendar, {
        //         headerToolbar: {
        //             left: '',
        //             center: 'title',
        //             right: ''
        //         },
        //         initialView: "timeGridWeek",
        //         slotMinTime: "04:00:00",
        //         slotMaxTime: "23:00:00",
        //         nowIndicator: true,
        //         selectable: true,
        //         events: events,
        //         eventClick: (info) => {
        //             let eventId = info.event._def.publicId;
        //             let a = info.event._def.extendedProps;
        //             let tranzabadan = document.getElementById('tranzabadan');
        //             let eventStartTime = new Date(a.start_time);
        //             let eventEndTime = new Date(a.end_time);
        //             let nowDate = new Date();

        //             if (validateOwner(info)) {
        //                 deleteEventForm.action = `/calendar/delete/${eventId}`;
        //                 deleteEventBtn.click();
        //             }
        //         },
        //         select: (info) => {
        //             if (info.end.getDate() - info.start.getDate() > 0 && !info.allDay) {
        //                 return;
        //             }
        //             start.value = info.startStr.slice(0, info.startStr.length - 6);
        //             end.value = info.endStr.slice(0, info.endStr.length - 6);
        //             course.click();
        //         }
        //     });

        //     calendar.render();

        //     function validateOwner(info) {
        //         let owner = info.event._def.extendedProps.owner;
        //         let authUser = `{{ Auth::user()->id }}`;
        //         return owner == authUser;
        //     }
        // });
                    document.addEventListener('DOMContentLoaded', async function() {
                        let response = await axios.get("/calendar/create")
                        let events = response.data.events


                        let nowDate = new Date()
                        let day = nowDate.getDate()
                        let month = nowDate.getMonth() + 1
                        let hours = nowDate.getHours()
                        let minutes = nowDate.getMinutes()
                        let minTimeAllowed =
                            `${nowDate.getFullYear()}-${month < 10 ? "0"+month : month}-${day < 10 ? "0"+day : day}T${hours < 10 ? "0"+hours : hours}:${minutes < 10 ? "0"+minutes : minutes}:00`
                        start.min = minTimeAllowed;


                        var myCalendar = document.getElementById('calendar');



                        var calendar = new FullCalendar.Calendar(myCalendar, {

                            headerToolbar: {
                                left: '',
                                center: 'title',
                                right: ''
                            },


                            views: {
                                listDay: { // Customize the name for listDay
                                    buttonText: 'Day Events',

                                },
                                listWeek: { // Customize the name for listWeek
                                    buttonText: 'Week Events'
                                },
                                listMonth: { // Customize the name for listMonth
                                    buttonText: 'Month Events'
                                },
                                timeGridWeek: {
                                    buttonText: 'Week', // Customize the button text
                                },
                                timeGridDay: {
                                    buttonText: "Day",
                                },
                                dayGridMonth: {
                                    buttonText: "Month",
                                },

                            },


                            initialView: "timeGridWeek", // initial view  =   l view li kayban  mni kan7ol l  calendar
                            slotMinTime: "04:00:00", // min  time  appear in the calendar
                            slotMaxTime: "23:00:00", // max  time  appear in the calendar
                            nowIndicator: true, //  indicator  li kaybyen  l wa9t daba   fin  fl calendar
                            selectable: true, //   kankhali l user  i9ad  i selectioner  wast l calendar
                            selectMirror: true, //  overlay   that show  the selected area  ( details  ... )
                            selectOverlap: false, //  nkhali ktar mn event f  nfs  l wa9t  = e.g:   5 nas i reserviw nfs lblasa  f nfs l wa9t
                            weekends: true, // n7ayed  l weekends    ola nkhalihom 
                            editable: true,
                            droppable: true,


                            // events  hya  property dyal full calendar
                            //  kat9bel array dyal objects  khass  i kono jayin 3la chkl  object fih  start  o end  7it hya li kayfahloha
                            events: events,

                            eventDrop: (info) => {
                                updateEvent(info)

                            },
                            eventResize: (info) => {

                                updateEvent(info)
                            },

                            eventClick: (info) => {

                                let eventId = info.event._def.publicId
                                console.log(info.event._def.extendedProps);
                                let a = info.event._def.extendedProps
                                let tranzabadan = document.getElementById('tranzabadan');
                                let eventStartTime = new Date(a.start_time);
                                let eventEndTime = new Date(a.end_time);

                                if (validateOwner(info)) {
                                    deleteEventForm.action = `/calendar/delete/${eventId}`
                                    deleteEventBtn.click()
                                } else {
                                    show.click()
                                    let name = document.getElementById('name');
                                    let description = document.getElementById('description');
                                    let place = document.getElementById('place');
                                    let time = document.getElementById('time');
                                    let time2 = document.getElementById('time2');
                                    let calendar_id = document.getElementById('calendar_id');


                                    if (events.length > 0) {

                                        calendar_id.value = info.event._def.publicId;
                                        name.textContent = "Course Name : " + a.name;
                                        description.textContent = "About the course : " + a.description;
                                        place.textContent = "Places left  : " + a.places;
                                        time.textContent = "Start At : " + a.start_time;
                                        time2.textContent = "End At   : " + a.end_time;
                                        if (eventStartTime <= nowDate && eventEndTime >= nowDate) {
                                            tranzabadan.textContent = "Take the course";
                                            tranzabadan.classList.remove('cursor-not-allowed', 'bg-green-500');
                                            tranzabadan.classList.add('bg-blue-500', 'hover:bg-blue-600');
                                        } else {
                                            tranzabadan.type = "button";
                                            tranzabadan.textContent = "The course is not available";
                                            tranzabadan.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                                            tranzabadan.classList.add('bg-green-500', 'cursor-not-allowed');
                                        }

                                    }
                                }

                            },

                            selectAllow: (info) => {

                                return info.start >= nowDate;
                            },

                            select: (info) => {
                                console.log(info);


                                if (info.end.getDate() - info.start.getDate() > 0 && !info.allDay) {
                                    return
                                }


                                start.value = info.startStr.slice(0, info.startStr.length - 6)
                                end.value = info.endStr.slice(0, info.endStr.length - 6)
                                course.click()

                            },

                        });

                        calendar.render();

                        function updateEvent(info) {

                            let eventInfo = info.event._def
                            let eventTime = info.event._instance.range

                            if (eventTime.start > nowDate && validateOwner(info)) {
                                function formattedDate(time) {
                                    let date = new Date(time);
                                    return date.toISOString().slice(0, 19);
                                }

                                updatedStart.value = formattedDate(eventTime.start)
                                updatedEnd.value = formattedDate(eventTime.end)



                                updateForm.action = `/calendar/update/${eventInfo.publicId}`

                                submitUpdate.click()

                            } else {
                                window.location.reload()
                            }
                        };

                        function validateOwner(info) {
                            let owner = info.event._def.extendedProps.owner
                            let authUser = `{{ Auth::user()->id }}`

                            return owner == authUser
                        }


                    })
    </script>
</body>
</html>