@extends('layouts.frontend')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">About Us</h1>
            <div class="w-24 h-1 bg-red-600 mx-auto mb-8"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h2 class="text-3xl font-semibold text-gray-900">Welcome to StiegoApp</h2>
                <p class="text-gray-600 leading-relaxed">
                    StiegoApp is your trusted partner in delivering high-quality products and excellent service. 
                    We are committed to providing the best shopping experience for our customers.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Our mission is to make quality products accessible to everyone while maintaining 
                    the highest standards of customer service and satisfaction.
                </p>
                <div class="grid grid-cols-2 gap-6 mt-8">
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-2xl font-bold text-red-600">1000+</h3>
                        <p class="text-gray-600">Happy Customers</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-2xl font-bold text-red-600">500+</h3>
                        <p class="text-gray-600">Products</p>
                    </div>
                </div>
            </div>
            <div class="relative h-96">
                <img src="https://placehold.co/600x400" alt="About Us Image" 
                     class="rounded-lg shadow-lg object-cover w-full h-full">
            </div>
        </div>

        <!-- Values Section -->
        <div class="mt-24">
            <h2 class="text-3xl font-semibold text-center text-gray-900 mb-12">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Quality</h3>
                    <p class="text-gray-600">We never compromise on the quality of our products.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Reliability</h3>
                    <p class="text-gray-600">Count on us for timely delivery and consistent service.</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Customer First</h3>
                    <p class="text-gray-600">Your satisfaction is our top priority.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection