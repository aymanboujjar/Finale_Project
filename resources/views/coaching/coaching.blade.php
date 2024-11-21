<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnova</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href={{ asset("storage/images/logo.png") }} type="image/x-icon">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

</head>
<body class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500 min-h-screen font-sans leading-relaxed text-gray-800">

    <!-- Navbar -->
    @if (Route::has('login'))
    <nav class="w-full py-4 px-8 flex justify-between items-center bg-white shadow-md rounded-b-lg">
        <h1 class="text-3xl font-extrabold text-blue-600">Learnova</h1>
        <div class="relative inline-block text-left">
            <!-- Dropdown Button -->
            <button 
                class="inline-flex items-center justify-center w-full rounded-md  px-4 py-2 bg-white text-sm font-medium text-gray-700 "
                onclick="toggleDropdown()"
                id="menu-button"
                aria-expanded="false"
                aria-haspopup="true">
                <span>{{ Auth::user()->name }}</span>
                <!-- Profile Image -->
                <img src={{ asset('storage/' . Auth::user()->image) }}
                     alt="Profile Picture" 
                     class="w-8 h-8 rounded-full ml-2">
            
            </button>
        
            <!-- Dropdown Menu -->
            <div 
                id="dropdown-menu" 
                class="hidden absolute right-0 z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                <div class="py-1">
                    <!-- Profile Link -->
                    <a href="{{ url('/profile') }}" 
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Profile
                    </a>
                    @if (Auth::user() && Auth::user()->hasRole(['coach']))
                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">Coaching</a>
                @endif
                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" 
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- JavaScript -->
        <script>
            function toggleDropdown() {
                const dropdown = document.getElementById('dropdown-menu');
                dropdown.classList.toggle('hidden');
            }
        </script>
        
        
    </nav>
    @endif

    <!-- Welcome Section -->
    <div class="text-center mt-20">
        <h2 class="text-5xl font-extrabold text-white">Welcome to your coaching profile</h2>
     <ul class="flex items-center justify-center gap-x-4 mt-4">
        <li>
            <button id="class" class=" flex bg-rose-500 text-white rounded-md px-4 py-2 hover:bg-rose-700 transition"
            onclick="openModal('classmodal')">
            Create Class
                </button>
        </li>
        <li>
            <button id="course" class=" flex bg-rose-500 text-white rounded-md px-4 py-2 hover:bg-rose-700 transition"
            onclick="openModal('coursemodal')">
            Create course
                </button>
        </li>
        <li>
            <button id="Lesson" class=" flex bg-rose-500 text-white rounded-md px-4 py-2 hover:bg-rose-700 transition"
            onclick="openModal('lessonsmodal')">
            Create lessons
                </button>
        </li>
        <button id="show" class=" hidden bg-rose-500 text-white rounded-md px-4 py-2 hover:bg-rose-700 transition"
            onclick="openModal('showcourse')">
            Create course
        </button>
     </ul>
     

<div id="showcourse" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
    <div class="relative top-20 mx-auto shadow-xl rounded-md bg-white max-w-md">

        <div class="flex justify-end p-2">
            <button onclick="closeModal('showcourse')" type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <div id="div" class="p-6 max-w-lg mx-auto bg-white rounded-lg shadow-md space-y-4">
            <h1 id="name" class="text-2xl font-bold text-gray-800"></h1>
            <h1 id="description" class="text-sm text-gray-600"></h1>
            <h1 id="place" class="text-lg text-gray-700"></h1>
            <h1 id="time" class="text-md text-blue-600"></h1>
            <h1 id="time2" class="text-md text-blue-600"></h1>
            
            <form action="{{ route('course_user.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
                <input type="hidden" id="calendar_id" name="calendar_id" >
                <button id="tranzabadan" class="px-4 flex w-full justify-center items-center py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg">Take it now</button>
            </form>
        </div>
          
 

  

    </div>
</div>

<script type="text/javascript">

    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = 'block'
        document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = 'none'
        document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function(event) {
        event = event || window.event;
        if (event.keyCode === 27) {
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
            let modals = document.getElementsByClassName('modal');
            Array.prototype.slice.call(modals).forEach(i => {
                i.style.display = 'none'
            })
        }
    };
</script>

        <div class="mt-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
            
    
                <div class="">
                    <form class="hidden" id="updateForm" method="post" action="">
                        @csrf @method('PUT')
                        <input id="updatedStart" name="start" type="hidden">
                        <input id="updatedEnd" name="end" type="hidden">
                        <button id="submitUpdate"></button>
                    </form>
                </div>
                @include('components.delete_event')
    
                <div class="w-full h-[90vh] bg-white rounded-3xl border-none p-3" id="calendar"></div>
    
    
                <script>
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
                                left: 'prev,next,dayGridMonth,timeGridWeek,timeGridDay',
                                center: 'title',
                                right: 'listMonth,listWeek,listDay'
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
                            slotMaxTime: "19:00:00", // max  time  appear in the calendar
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
                                let a =info.event._def.extendedProps
                                let tranzabadan = document.getElementById('tranzabadan');
                                let eventStartTime = new Date(a.start_time);
                                let eventEndTime = new Date(a.end_time);

                                if (validateOwner(info)) {
                                    deleteEventForm.action = `/calendar/delete/${eventId}`
                                    deleteEventBtn.click()
                                }else{
                                    show.click()
                                    let name = document.getElementById('name');
                                    let description = document.getElementById('description');
                                    let place = document.getElementById('place');
                                    let time = document.getElementById('time');
                                    let time2 = document.getElementById('time2');
                                    let calendar_id = document.getElementById('calendar_id');

                            
                                    if (events.length > 0) {
                                        
                                            calendar_id.value = info.event._def.publicId;
                                                name.textContent ="Course Name : " + a.name;
                                                description.textContent ="About the course : " + a.description;
                                                place.textContent ="Places left  : " + a.places;
                                                time.textContent ="Start At : " + a.start_time;
                                                time2.textContent ="End At   : " + a.end_time;
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
    
    
            </div>
        </div>
       
        
    </div>

 
    @include('components.create_classe')
    @include('components.create_courses')
    @include('components.create_lessons')

    <footer class="mt-20 py-6 w-full text-center bg-white shadow-t-md">
        <p class="text-gray-600">&copy; 2024 Learnova. All rights reserved.</p>
    </footer>
</body>
</html>
