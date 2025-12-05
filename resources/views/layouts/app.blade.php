<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Alertify CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>

    {{-- Favicon --}}
    <link rel="icon" href="{{ $settings->favicon }}" />

    {{-- Tailwind CSS & Alpine.js --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <title>{{ $settings->title }} — Forex Signals & Courses</title>
    <style>
        [x-cloak] { display: none !important; }
    
        html { 
        scroll-behavior: smooth; 
        }

        @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
        animation: fadeIn 0.8s ease forwards;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter antialiased bg-gray-50 text-gray-800">

    @if (session('success'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      alertify.set('notifier','position', 'top-right');
      alertify.success('{{ session('success') }}');
    });
    </script>

    @elseif (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        alertify.set('notifier','position', 'top-right');
        alertify.error('{{ session('error') }}');
        });
    </script>

    @endif

    @yield('content')


    <!-- Alertify JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

    <script>
    function app(){
      return {
        mobileNav: false,
        signalFilter: 'all',
        ui: { signinOpen:false, signupOpen:false, subscribeOpen:false, courseOpen:false, subscribingTo:null, activeCourse:null },
        form:{ name:'', email:'', password:'' },
        subscriptions: [],
        signals: [
          {id:1, title:'EURUSD Long', time:'2025-11-21 08:30', note:'Breakout above resistance. Use 1.0850 as entry', tp:'1.0900', sl:'1.0800', action:'BUY', type:'fx'},
          {id:2, title:'GBPUSD Short', time:'2025-11-21 07:45', note:'Rejection at supply zone', tp:'1.2300', sl:'1.2450', action:'SELL', type:'fx'},
          {id:3, title:'BTCUSD Scalping', time:'2025-11-21 09:00', note:'Momentum scalp opportunity', tp:'61000', sl:'59000', action:'BUY', type:'crypto'},
        ],
        courses: [
          {id:1, title:'Forex Price Action Mastery', desc:'Learn price action strategies for FX.', long:'Full course detail...','image':'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=60','price':'$99','author':'John Trader','lessons':[ {id:1,title:'Intro',duration:'8m'},{id:2,title:'Support & Resistance',duration:'20m'} ]},
          {id:2, title:'Beginner to Pro Trading', desc:'Step-by-step trading course.', long:'Full course detail...','image':'https://images.unsplash.com/photo-1517433456452-f9633a875f6f?auto=format&fit=crop&w=1200&q=60','price':'$79','author':'Jane Analyst','lessons':[ {id:1,title:'Basics',duration:'12m'},{id:2,title:'Indicators',duration:'30m'} ]},
          {id:3, title:'Algorithmic Trading for Retail', desc:'Build simple algos for trading.', long:'Full course detail...','image':'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=60','price':'$129','author':'Quant Guy','lessons':[ {id:1,title:'Python Intro',duration:'25m'},{id:2,title:'Backtesting',duration:'40m'} ]}
        ],
        recentSignals: [],

        filteredSignals(){
          if(this.signalFilter==='all') return this.signals;
          return this.signals.filter(s=> s.type=== (this.signalFilter==='fx'? 'fx':'crypto') );
        },

        openSignup(){ this.ui.signupOpen = true; },
        openSignin(){ this.ui.signinOpen = true; },
        openSubscribe(signal){ this.ui.subscribingTo = signal; this.ui.subscribeOpen = true; },
        confirmSubscribe(plan){
          // simulate subscription
          this.subscriptions.push({ id: Date.now(), name: this.ui.subscribingTo.title || 'Signal Plan', expires: '2026-11-21' });
          this.ui.subscribeOpen = false;
          alert('Subscribed ('+plan+'). This is a UI demo.');
        },
        openCourse(course){ this.ui.activeCourse = course; this.ui.courseOpen = true; },
        playLesson(lesson){ alert('Playing lesson: '+lesson.title+' (demo)') },
        manageSub(sub){ alert('Manage subscription: '+sub.name) },
        demoBot(which){ alert('Demoing '+which+' bot (UI only)') },
        openSubscribeFromList(signal){ this.openSubscribe(signal); },
        navAnimate(e){
          const el = e.currentTarget; el.classList.add('scale-105'); setTimeout(()=>el.classList.remove('scale-105'),250);
        },
        scrollTo(sel){ document.querySelector(sel).scrollIntoView({ behavior:'smooth' }); }
      }
    }
  </script>
</body>

</html>
