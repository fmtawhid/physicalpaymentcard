@extends('merchant.layout.layout')

@section('content')
    <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Revenue</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">$124,560</p>
                    </div>
                    <div class="bg-green-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-dollar-sign text-green-600"></i>
                    </div>
                </div>
                <p class="text-xs text-green-600 mt-2"><i class="fas fa-arrow-up mr-1"></i> 12.5% from last
                    month</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Transactions</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">8,742</p>
                    </div>
                    <div class="bg-blue-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-exchange-alt text-blue-600"></i>
                    </div>
                </div>
                <p class="text-xs text-blue-600 mt-2"><i class="fas fa-arrow-up mr-1"></i> 8.2% from last month
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-purple-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Active Merchants</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">342</p>
                    </div>
                    <div class="bg-purple-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-users text-purple-600"></i>
                    </div>
                </div>
                <p class="text-xs text-purple-600 mt-2"><i class="fas fa-arrow-up mr-1"></i> 5.3% from last
                    month</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 border-l-4 border-red-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Failed Transactions</p>
                        <p class="text-xl md:text-2xl font-bold text-gray-800">127</p>
                    </div>
                    <div class="bg-red-100 p-2 md:p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                </div>
                <p class="text-xs text-red-600 mt-2"><i class="fas fa-arrow-down mr-1"></i> 3.1% from last month
                </p>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
            <!-- Revenue Chart -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-4 md:p-5">
                <div class="flex justify-between items-center mb-4 md:mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Revenue Overview</h3>
                    <div class="flex space-x-2">
                        <button
                            class="px-3 py-1 text-xs bg-primary-100 text-primary-700 rounded-lg">Monthly</button>
                        <button
                            class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg">Quarterly</button>
                        <button class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg">Yearly</button>
                    </div>
                </div>
                <div
                    class="h-48 md:h-64 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-200">
                    <p class="text-gray-500 text-center p-4">Revenue chart visualization would appear here with
                        integration to chart libraries</p>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white rounded-xl shadow-sm p-4 md:p-5">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 md:mb-6">Recent Transactions</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div>
                            <p class="font-medium text-gray-800">Merchant Co.</p>
                            <p class="text-xs text-gray-500">Today, 10:24 AM</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-green-600">$245.50</p>
                            <p class="text-xs text-gray-500">Completed</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div>
                            <p class="font-medium text-gray-800">Retail Store</p>
                            <p class="text-xs text-gray-500">Today, 09:15 AM</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-green-600">$1,240.00</p>
                            <p class="text-xs text-gray-500">Completed</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <div>
                            <p class="font-medium text-gray-800">Online Shop</p>
                            <p class="text-xs text-gray-500">Today, 08:42 AM</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-red-600">$89.99</p>
                            <p class="text-xs text-gray-500">Failed</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-800">Service Provider</p>
                            <p class="text-xs text-gray-500">Yesterday, 05:30 PM</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-green-600">$560.75</p>
                            <p class="text-xs text-gray-500">Completed</p>
                        </div>
                    </div>
                </div>
                <button
                    class="w-full mt-4 py-2 text-sm text-primary-700 font-medium rounded-lg border border-primary-200 hover:bg-primary-50">
                    View All Transactions
                </button>
            </div>
        </div>

        <!-- System Status -->
        <div class="mt-6 bg-white rounded-xl shadow-sm p-4 md:p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Gateway Status</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Primary Gateway</p>
                        <p class="text-xs text-gray-500">Operational</p>
                    </div>
                </div>
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Backup Gateway</p>
                        <p class="text-xs text-gray-500">Standby</p>
                    </div>
                </div>
                <div class="flex items-center p-3 md:p-4 rounded-lg border border-gray-200">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-3"></div>
                    <div>
                        <p class="font-medium text-sm md:text-base">Security Systems</p>
                        <p class="text-xs text-gray-500">Active</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
     
   