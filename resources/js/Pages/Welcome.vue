<template>
  <div class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800 min-h-screen">
    <!-- Header Navigation -->
    <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md shadow-sm border-b border-slate-200 dark:border-slate-700 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <span class="text-xl font-bold text-slate-900 dark:text-white">Payroll System</span>
        </div>
        <div class="flex items-center gap-3">
          <Link
            href="/login"
            class="px-5 py-2.5 text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors"
          >
            Sign In
          </Link>
          <Link
            href="/register"
            class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all transform hover:scale-105"
          >
            Get Started
          </Link>
        </div>
      </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <!-- Hero Section -->
      <div class="text-center mb-20">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full font-medium mb-8">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
          </svg>
          Modern Payroll Management
        </div>
        <h1 class="text-6xl md:text-7xl font-extrabold text-slate-900 dark:text-white mb-6 leading-tight">
          Streamline Your
          <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent"> Payroll</span>
        </h1>
        <p class="text-xl md:text-2xl text-slate-600 dark:text-slate-300 mb-12 max-w-3xl mx-auto leading-relaxed">
          Simplify employee management, attendance tracking, and payroll processing with our comprehensive, easy-to-use platform
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
          <Link
            href="/login"
            class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-bold text-lg shadow-2xl hover:shadow-blue-500/50 transition-all transform hover:scale-105"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Sign In Now
          </Link>
          <Link
            href="/register"
            class="inline-flex items-center gap-2 px-8 py-4 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-900 dark:text-white rounded-xl font-bold text-lg shadow-xl border-2 border-slate-200 dark:border-slate-700 hover:border-blue-500 dark:hover:border-blue-500 transition-all"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            Create Free Account
          </Link>
        </div>
      </div>

      <!-- Features -->
      <div class="grid md:grid-cols-3 gap-8 mb-20">
        <div class="group bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-lg hover:shadow-2xl border border-slate-200 dark:border-slate-700 transition-all transform hover:scale-105">
          <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 shadow-lg group-hover:shadow-xl transition-all">
            <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Employee Management</h3>
          <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Effortlessly manage employee records, positions, contact information, and salary details in one centralized system.</p>
        </div>
        <div class="group bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-lg hover:shadow-2xl border border-slate-200 dark:border-slate-700 transition-all transform hover:scale-105">
          <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mb-6 shadow-lg group-hover:shadow-xl transition-all">
            <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Attendance Tracking</h3>
          <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Monitor employee attendance and working hours with precision. Track absences, overtime, and work patterns seamlessly.</p>
        </div>
        <div class="group bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-lg hover:shadow-2xl border border-slate-200 dark:border-slate-700 transition-all transform hover:scale-105">
          <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6 shadow-lg group-hover:shadow-xl transition-all">
            <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Payroll Processing</h3>
          <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Automate payroll calculations with allowances, deductions, and tax computations. Generate payslips instantly.</p>
        </div>
      </div>

      <!-- Stats Section -->
      <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-12 shadow-2xl text-white text-center mb-20">
        <h2 class="text-4xl font-bold mb-4">Trusted by Organizations Worldwide</h2>
        <p class="text-xl text-blue-100 mb-12">Join thousands of companies managing payroll efficiently</p>
        <div class="grid md:grid-cols-4 gap-8">
          <div>
            <div class="text-5xl font-extrabold mb-2">99.9%</div>
            <div class="text-blue-100">Uptime</div>
          </div>
          <div>
            <div class="text-5xl font-extrabold mb-2">24/7</div>
            <div class="text-blue-100">Support</div>
          </div>
          <div>
            <div class="text-5xl font-extrabold mb-2">100%</div>
            <div class="text-blue-100">Secure</div>
          </div>
          <div>
            <div class="text-5xl font-extrabold mb-2">Fast</div>
            <div class="text-blue-100">Processing</div>
          </div>
        </div>
      </div>

      <!-- CTA Section -->
      <div class="bg-white dark:bg-slate-800 rounded-3xl p-12 shadow-xl border border-slate-200 dark:border-slate-700 text-center">
        <h2 class="text-4xl font-bold text-slate-900 dark:text-white mb-4">Ready to Get Started?</h2>
        <p class="text-xl text-slate-600 dark:text-slate-400 mb-8">Start managing your payroll more efficiently today</p>
        <Link
          href="/register"
          class="inline-flex items-center gap-2 px-10 py-5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-bold text-lg shadow-2xl hover:shadow-blue-500/50 transition-all transform hover:scale-105"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
          </svg>
          Create Your Free Account
        </Link>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-8 mt-20 relative">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="flex items-center justify-center gap-2 mb-3">
          <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
          <span class="text-lg font-bold text-slate-900 dark:text-white">PayrollPro</span>
        </div>
        <p class="text-slate-600 dark:text-slate-400 mb-2">&copy; 2026 Payroll Management System. All rights reserved.</p>
        <p class="text-sm text-slate-500 dark:text-slate-500 mb-3">Built with ❤️ for modern businesses</p>
        <div class="flex items-center justify-center gap-2 text-xs text-slate-400 dark:text-slate-600 border-t border-slate-200 dark:border-slate-800 pt-4 mt-4">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span>Proprietary Software - Unauthorized reproduction or distribution is prohibited</span>
        </div>
      </div>
      
      <!-- Decorative watermark background -->
      <div class="absolute inset-0 overflow-hidden opacity-5 pointer-events-none">
        <div class="absolute -bottom-20 -right-20 text-slate-400 dark:text-slate-600 transform rotate-12">
          <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
          </svg>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
