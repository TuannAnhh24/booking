@extends('client.yourproperty.yourproperty')
@section('content')

    <!-- Bên trái  -->
    <div class="flex max-w-6xl mx-auto px-4">
        <div class="w-7/12 pt-5">
            <span class="block text-white font-bold text-4xl pt-3">{{__('content.yourproperty.yourproperty_left.content_1')}}</span>
            <span class="block text-blue-400 font-bold text-4xl pt-3">{{__('content.yourproperty.yourproperty_left.content_2')}}</span>
            <span class="block text-white font-bold text-4xl pt-3">{{__('content.yourproperty.yourproperty_left.content_3')}}</span>
            <span class="block text-white font-normal text-2xl pt-4 pb-9">{{__('content.yourproperty.yourproperty_left.content_4')}}
                <br />
                {{__('content.yourproperty.yourproperty_left.content_5')}}
                <br />
                {{__('content.yourproperty.yourproperty_left.content_6')}}</span>
        </div>
        <!-- Bên Phải  -->
        <div class="pl-16 mb-14">
            <div class="bg-white border-4 border-yellow-500 rounded-md">
                <div class="rounded-md">
                    <span class="block font-bold text-xl pl-6 py-4"> {{__('content.yourproperty.yourproperty_right.content_1')}}</span>
                    <div class="flex items-center mt-4">
                        <i class="text-green-400 fas fa-check text-xl pl-8"></i>
                        <span class="pl-3 ml-2"> {{__('content.yourproperty.yourproperty_right.content_2')}}<br />
                            {{__('content.yourproperty.yourproperty_right.content_3')}}</span>
                    </div>
                    <div class="flex items-center mt-4">
                        <i class="text-green-400 fas fa-check text-xl pl-8"></i>
                        <span class="pl-3 ml-2">{{__('content.yourproperty.yourproperty_right.content_4')}}
                            <br />
                            {{__('content.yourproperty.yourproperty_right.content_5')}}</span>
                    </div>
                    <div class="flex items-center mt-4 pb-5">
                        <i class="text-green-400 fas fa-check text-xl pl-8"></i>
                        <span class="pl-3 ml-2">{{__('content.yourproperty.yourproperty_right.content_6')}}</span>
                    </div>
                </div>
                <hr />
                <div class="">
                    <form action="{{ route('users.property.start') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-white hover:bg-blue-800 bg-blue-700 px-5 mx-11 my-5 w-4/5 h-12">
                            {{__('content.yourproperty.yourproperty_right.content_7')}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection