<!DOCTYPE html>
<html lang="en" x-data="app()">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <title>SignalLearn — Forex Signals & Courses</title>
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

</head>
<body class="font-inter antialiased bg-gray-50 text-gray-800">

  <!-- NAVBAR -->
  <header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="text-2xl font-bold text-indigo-600">SignalLearn</div>
        {{-- <div class="hidden md:flex items-center text-sm text-gray-600">Signals · Courses · Dashboard</div> --}}
      </div>

      <nav class="hidden md:flex space-x-4 items-center">
        <a href="#hero" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Home</a>
        <a href="#signals" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Signals</a>
        <a href="#courses" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Courses</a>
        <a href="#bots" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Bots</a>
        <a href="#dashboard" @click="navAnimate($event)" class="px-3 py-2 hover:text-indigo-600">Dashboard</a>
      </nav>

      <div class="flex items-center gap-3">
        <button @click="openSignin()" class="hidden md:inline-block px-4 py-2 bg-white-600 text-black rounded-lg">Log in</button>
        <button @click="openSignup()" class="hidden md:inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg">Register</button>
        <button class="md:hidden text-2xl" @click="mobileNav = !mobileNav">☰</button>
      </div>
    </div>

    <!-- Mobile nav -->
    <div x-show="mobileNav" @click.away="mobileNav=false" x-transition class="md:hidden bg-white border-t">
      <div class="px-4 py-3 flex flex-col">
        <a href="#hero" @click="mobileNav=false; navAnimate($event)" class="py-2">Home</a>
        <a href="#signals" @click="mobileNav=false; navAnimate($event)" class="py-2">Signals</a>
        <a href="#courses" @click="mobileNav=false; navAnimate($event)" class="py-2">Courses</a>
        <a href="#bots" @click="mobileNav=false; navAnimate($event)" class="py-2">Bots</a>
        <a href="#dashboard" @click="mobileNav=false; navAnimate($event)" class="py-2">Dashboard</a>
        <button @click="mobileNav=false; openSignin()" class="mt-2 px-4 py-2 bg-white-600 text-black rounded">Log in</button>
        <button @click="mobileNav=false; openSignup()" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded">Get started</button>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section id="hero" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-28">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h1 class="text-4xl md:text-5xl font-extrabold">Forex Signals + Trading Courses — in one place</h1>
      <p class="mt-4 text-lg opacity-90">Subscribe to signal providers, follow trading strategies, and learn with hands-on courses.</p>
      <div class="mt-6 flex justify-center gap-4">
        <button @click="scrollTo('#signals');" class="px-6 py-3 bg-white text-indigo-700 rounded-lg font-semibold">Browse Signals</button>
        <button @click="scrollTo('#courses');" class="px-6 py-3 bg-indigo-700 text-white rounded-lg font-semibold">Browse Courses</button>
      </div>
    </div>
  </section>

  <!-- SIGNALS FEED -->
  <section id="signals" class="max-w-7xl mx-auto px-6 py-16">
    <div class="flex items-center justify-between mb-8">
      <h2 class="text-2xl font-bold">Live Signals</h2>
      <div class="flex gap-3 items-center">
        <select x-model="signalFilter" class="border rounded px-3 py-2 text-sm">
          <option value="all">All Pairs</option>
          <option value="fx">Forex</option>
          <option value="crypto">Crypto</option>
        </select>
        <button @click="openSignin()" class="px-3 py-2 bg-indigo-600 text-white rounded">Subscribe</button>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <template x-for="signal in filteredSignals()" :key="signal.id">
        <div class="bg-white rounded-xl shadow p-5">
          <div class="flex justify-between items-start">
            <div>
              <div class="text-sm text-gray-500" x-text="signal.time"></div>
              <h3 class="text-xl font-semibold" x-text="signal.title"></h3>
              <p class="text-gray-600 mt-2" x-text="signal.note"></p>
            </div>
            <div class="text-right">
              <div class="text-indigo-600 font-bold text-lg" x-text="signal.action"></div>
              <div class="text-sm text-gray-500 mt-1">TP: <span x-text="signal.tp"></span></div>
              <div class="text-sm text-gray-500">SL: <span x-text="signal.sl"></span></div>
              <button @click="openSubscribe(signal)" class="mt-3 px-3 py-1 border rounded text-sm">Subscribe</button>
            </div>
          </div>
        </div>
      </template>
    </div>
  </section>

  <!-- COURSES -->
  <section id="courses" class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Popular Courses</h2>
        <div class="text-sm text-gray-600">Browse courses & enroll</div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="course in courses" :key="course.id">
          <div class="bg-white rounded-xl shadow overflow-hidden">
            <img :src="course.image" class="w-full h-40 object-cover" />
            <div class="p-4">
              <h3 class="font-semibold text-lg" x-text="course.title"></h3>
              <p class="text-gray-600 mt-2 text-sm" x-text="course.desc"></p>
              <div class="mt-4 flex items-center justify-between">
                <div class="text-indigo-600 font-bold" x-text="course.price"></div>
                <div class="flex gap-2">
                  <button @click="openCourse(course)" class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">View</button>
                  <button @click="openSignin();" class="px-3 py-1 border rounded text-sm">Enroll</button>
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
  </section>

  <!-- TRADING BOTS -->
  <section id="bots" class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="text-2xl font-bold mb-6">Trading Bots</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-semibold text-xl">Crypto Trading Bot</h3>
        <p class="text-gray-600 mt-2">AI-driven strategies for crypto markets — subscription based.</p>
        <div class="mt-4 flex gap-3">
          <button @click="openSignin()" class="px-4 py-2 bg-indigo-600 text-white rounded">Subscribe</button>
          <button @click="demoBot('crypto')" class="px-4 py-2 border rounded">Demo</button>
        </div>
      </div>
      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-semibold text-xl">Forex Trading Bot</h3>
        <p class="text-gray-600 mt-2">Precision scalping & swing strategies tuned for FX pairs.</p>
        <div class="mt-4 flex gap-3">
          <button @click="openSignin()" class="px-4 py-2 bg-indigo-600 text-white rounded">Subscribe</button>
          <button @click="demoBot('forex')" class="px-4 py-2 border rounded">Demo</button>
        </div>
      </div>
    </div>
  </section>

<!-- ============================= -->
<!-- ⭐ TESTIMONIALS SECTION ⭐ -->
<!-- ============================= -->
<section id="testimonials" class="py-20 bg-gray-50 dark:bg-gray-900">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white">
      What Our Students Are Saying
    </h2>
    <p class="mt-3 text-gray-600 dark:text-gray-300">
      Trusted by traders and learners across the world
    </p>

    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Testimonial Card 1 -->
      <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
        <p class="text-gray-600 dark:text-gray-300 italic">
          "The signals are extremely accurate. I’ve doubled my portfolio in 3 months!"
        </p>
        <div class="mt-6 flex items-center justify-center space-x-3">
          <img src="https://i.pravatar.cc/100?img=25" class="w-12 h-12 rounded-full border" />
          <div class="text-left">
            <h4 class="font-semibold text-gray-800 dark:text-white">David Martins</h4>
            <p class="text-xs text-blue-600">Gold Signal Member</p>
          </div>
        </div>
      </div>

      <!-- Testimonial Card 2 -->
      <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
        <p class="text-gray-600 dark:text-gray-300 italic">
          "The course taught me how to analyze charts confidently. Highly recommended!"
        </p>
        <div class="mt-6 flex items-center justify-center space-x-3">
          <img src="https://i.pravatar.cc/100?img=14" class="w-12 h-12 rounded-full border" />
          <div class="text-left">
            <h4 class="font-semibold text-gray-800 dark:text-white">Amina Sule</h4>
            <p class="text-xs text-green-600">Course Student</p>
          </div>
        </div>
      </div>

      <!-- Testimonial Card 3 -->
      <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
        <p class="text-gray-600 dark:text-gray-300 italic">
          "Mentorship sessions gave me discipline & a real trading strategy. Worth every penny."
        </p>
        <div class="mt-6 flex items-center justify-center space-x-3">
          <img src="https://i.pravatar.cc/100?img=47" class="w-12 h-12 rounded-full border" />
          <div class="text-left">
            <h4 class="font-semibold text-gray-800 dark:text-white">Michael Lee</h4>
            <p class="text-xs text-purple-600">Mentorship Program</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


  <!-- FOOTER -->
  <footer class="bg-gray-900 text-gray-300 py-8">
    <div class="max-w-7xl mx-auto px-6 text-center text-sm">© 2025 SignalLearn — All rights reserved.</div>
  </footer>


  <!-- MODALS -->
  <!-- Signup Modal -->
  <div x-show="ui.signupOpen" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div x-show="ui.signupOpen" x-transition class="bg-white w-full max-w-md rounded-xl p-6 shadow">

      <h3 class="text-xl font-semibold mb-4">Create an account</h3>
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <input name="name" placeholder="Full name" class="w-full border rounded px-3 py-2 mb-2" />

        <input name="email" type="email" placeholder="Email" class="w-full border rounded px-3 py-2 mb-2" />

        <input name="phone" type="text" placeholder="Phone" class="w-full border rounded px-3 py-2 mb-2" />

        <input name="password" type="password" placeholder="Password" class="w-full border rounded px-3 py-2 mb-2" />

        <input name="password_confirmation" type="password" placeholder="Confirm Password" class="w-full border rounded px-3 py-2 mb-2" />

        <div class="flex gap-3 mt-3">
          <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Create account</button>
          <button type="button" @click="ui.signupOpen=false" class="px-4 py-2 border rounded">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Signin Modal -->
  <div x-show="ui.signinOpen" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div x-show="ui.signinOpen" x-transition class="bg-white w-full max-w-md rounded-xl p-6 shadow">

      <h3 class="text-xl font-semibold mb-4">Log in to your account</h3>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <input name="email" type="email" placeholder="Email" class="w-full border rounded px-3 py-2 mb-2" />

        <input name="password" type="password" placeholder="Password" class="w-full border rounded px-3 py-2 mb-2" />

        <div class="flex gap-3 mt-3">
          <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Log in</button>
          <button type="button" @click="ui.signinOpen=false" class="px-4 py-2 border rounded">Cancel</button>
        </div>
        <p class="mt-4">Not a user? <a class="text-indigo" href="{{ route('register') }}">Register</a></p>
      </form>
    </div>
  </div>

  <!-- Subscribe Drawer -->
  <div 
    x-show="ui.subscribeOpen" 
    x-transition.opacity 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
  >
    <div 
      x-show="ui.subscribeOpen" 
      x-transition 
      class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8 relative animate-fade-in"
    >
      <!-- Close button -->
      <button 
        @click="ui.subscribeOpen=false" 
        class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
      >
        ✕
      </button>

      <!-- Title -->
      <h3 class="text-2xl font-bold text-gray-800 text-center">
        Subscribe to <span class="text-indigo-600" x-text="ui.subscribingTo?.title"></span>
      </h3>
      <p class="text-center text-gray-500 mt-2 text-sm">
        Choose your preferred subscription plan
      </p>

      <!-- Pricing Options -->
      <div class="mt-6 space-y-4">
        
        <!-- Monthly Plan -->
        <div 
          @click="confirmSubscribe('monthly')" 
          class="border rounded-xl p-4 flex items-center justify-between cursor-pointer hover:border-indigo-600 transition"
        >
          <div>
            <h4 class="font-semibold text-gray-800">Monthly Plan</h4>
            <p class="text-gray-500 text-sm">Billed every 30 days</p>
          </div>
          <span class="text-indigo-600 font-bold text-lg">$29</span>
        </div>

        <!-- Yearly Plan -->
        <div 
          @click="confirmSubscribe('yearly')" 
          class="border rounded-xl p-4 flex items-center justify-between cursor-pointer hover:border-indigo-600 transition"
        >
          <div>
            <h4 class="font-semibold text-gray-800">Yearly Plan</h4>
            <p class="text-gray-500 text-sm">Save 20% — best value</p>
          </div>
          <span class="text-indigo-600 font-bold text-lg">$290</span>
        </div>
      </div>

      <!-- Info -->
      <p class="text-center text-xs text-gray-500 mt-6">
        Payment simulation only (UI demo)
      </p>

      <!-- Close button bottom -->
      <div class="mt-4 text-center">
        <button 
          @click="ui.subscribeOpen=false" 
          class="px-4 py-2 text-gray-600 hover:text-gray-800 text-sm"
        >
          Close
        </button>
      </div>
    </div>
  </div>

  <!-- Course Drawer -->
  <div x-show="ui.courseOpen" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div x-show="ui.courseOpen" x-transition class="bg-white w-full max-w-2xl rounded-xl p-6 shadow overflow-auto max-h-[80vh]">
      <div class="flex items-start justify-between">
        <div>
          <h3 class="text-xl font-semibold" x-text="ui.activeCourse?.title"></h3>
          <div class="text-sm text-gray-500 mt-1" x-text="ui.activeCourse?.author"></div>
        </div>
        <button @click="ui.courseOpen=false" class="text-gray-500">Close</button>
      </div>

      <div class="mt-4 grid md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
          <img :src="ui.activeCourse?.image" class="w-full h-48 object-cover rounded" />
          <p class="mt-4 text-gray-700" x-text="ui.activeCourse?.long"></p>
          <div class="mt-4">
            <h4 class="font-semibold">Lessons</h4>
            <ul class="mt-2 space-y-2">
              <template x-for="lesson in ui.activeCourse?.lessons" :key="lesson.id">
                <li class="flex items-center justify-between bg-gray-50 p-3 rounded">
                  <div>
                    <div class="font-medium" x-text="lesson.title"></div>
                    <div class="text-xs text-gray-500" x-text="lesson.duration"></div>
                  </div>
                  <div>
                    <button @click="playLesson(lesson)" class="px-3 py-1 border rounded text-sm">Play</button>
                  </div>
                </li>
              </template>
            </ul>
          </div>
        </div>
        <div>
          <div class="bg-gray-50 p-4 rounded">
            <div class="text-sm text-gray-600">Price</div>
            <div class="text-xl font-bold mt-1" x-text="ui.activeCourse?.price"></div>
            <button @click="openSignin()" class="mt-4 w-full px-3 py-2 bg-indigo-600 text-white rounded">Enroll</button>
          </div>
        </div>
      </div>
    </div>
  </div>

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
