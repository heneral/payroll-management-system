<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Payslip Details</h1>
        <div class="flex gap-4">
          <button @click="downloadPDF" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Download PDF
          </button>
          <Link href="/payslips" class="px-4 py-2 bg-slate-600 text-white rounded hover:bg-slate-700">
            Back to Payslips
          </Link>
        </div>
      </div>

      <!-- Payslip Content -->
      <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg p-8">
        <!-- Header Info -->
        <div class="grid grid-cols-2 gap-8 mb-8 pb-8 border-b border-slate-300 dark:border-slate-600">
          <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">{{ payslip.employee.first_name }} {{ payslip.employee.last_name }}</h2>
            <p class="text-slate-600 dark:text-slate-400">{{ payslip.employee.position }}</p>
            <p class="text-slate-600 dark:text-slate-400">Employee ID: {{ payslip.employee.employee_id }}</p>
          </div>
          <div class="text-right">
            <p class="text-lg font-semibold text-slate-900 dark:text-white">Payslip #{{ payslip.payslip_number || `PS-${payslip.id}` }}</p>
            <p class="text-slate-600 dark:text-slate-400">Period: {{ formatDate(payslip.period_start) }} - {{ formatDate(payslip.period_end) }}</p>
            <p :class="{
              'text-amber-600': payslip.status === 'draft',
              'text-blue-600': payslip.status === 'approved',
              'text-emerald-600': payslip.status === 'paid',
            }" class="font-semibold mt-2">
              Status: {{ payslip.status.charAt(0).toUpperCase() + payslip.status.slice(1) }}
            </p>
          </div>
        </div>

        <!-- Salary Details -->
        <div class="grid grid-cols-2 gap-8 mb-8">
          <div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Earnings</h3>
            <div class="space-y-3">
              <div class="flex justify-between">
                <span class="text-slate-600 dark:text-slate-400">Base Salary</span>
                <span class="text-slate-900 dark:text-white">{{ formatCurrency(payslip.base_salary) }}</span>
              </div>
              <div v-for="allowance in payslip.allowances" :key="allowance.id" class="flex justify-between">
                <span class="text-slate-600 dark:text-slate-400">{{ allowance.type }}</span>
                <span class="text-slate-900 dark:text-white">{{ formatCurrency(allowance.amount) }}</span>
              </div>
              <div class="pt-3 border-t border-slate-300 dark:border-slate-600 flex justify-between font-semibold">
                <span class="text-slate-900 dark:text-white">Total Allowances</span>
                <span class="text-slate-900 dark:text-white">{{ formatCurrency(payslip.total_allowances) }}</span>
              </div>
              <div class="pt-3 border-t border-slate-300 dark:border-slate-600 flex justify-between text-lg font-bold">
                <span class="text-slate-900 dark:text-white">Gross Pay</span>
                <span class="text-emerald-600 dark:text-emerald-400">{{ formatCurrency(payslip.gross_pay) }}</span>
              </div>
            </div>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Deductions</h3>
            <div class="space-y-3">
              <div v-for="deduction in payslip.deductions" :key="deduction.id" class="flex justify-between">
                <span class="text-slate-600 dark:text-slate-400">{{ deduction.type }}</span>
                <span class="text-slate-900 dark:text-white">{{ formatCurrency(deduction.amount) }}</span>
              </div>
              <div class="pt-3 border-t border-slate-300 dark:border-slate-600 flex justify-between font-semibold">
                <span class="text-slate-900 dark:text-white">Total Deductions</span>
                <span class="text-slate-900 dark:text-white">{{ formatCurrency(payslip.total_deductions) }}</span>
              </div>
              <div class="pt-3 border-t border-slate-300 dark:border-slate-600 flex justify-between text-lg font-bold">
                <span class="text-slate-900 dark:text-white">Net Pay</span>
                <span class="text-emerald-600 dark:text-emerald-400">{{ formatCurrency(payslip.net_pay) }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="pt-8 border-t border-slate-300 dark:border-slate-600 text-sm text-slate-600 dark:text-slate-400">
          <p>Generated on {{ formatDate(new Date()) }}</p>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  payslip: Object,
});

const formatCurrency = (value) => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
  }).format(value);
};

const formatDate = (date) => {
  if (!date) return '';
  const d = new Date(date);
  return d.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
};

const downloadPDF = () => {
  alert('PDF download feature will be implemented soon');
  // TODO: Implement PDF download using a library like dompdf or tcpdf
};
</script>
