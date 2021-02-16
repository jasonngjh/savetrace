<div class="container px-8 py-15 mx-auto lg:px-4 text-gray-700 body-font">
    <h2 class="font-bold text-3xl text-gray-800 leading-tight">
        Request New Appointment
    </h2>

    <div class="flex flex-wrap">
        <div class="bg-white shadow-lg rounded-lg w-full my-4">
            <div class="py-4 px-4">
                <div class="pt-4">
                    <x-jet-label for="practice_place" value="{{ __('Select An Area') }}" />
                    <div class="flex md:flex-row md:justify-evenly">
                        <div>
                            <button wire:click.prevent="getArea('C')" class="py-2 px-5 bg-blue-100 hover:bg-blue-300 active:bg-gray-100 rounded-lg text-blue-700 ml-4">Central</button>
                        </div>
                        <div>
                            <button wire:click.prevent="getArea('N')" class="py-2 px-5 bg-blue-100 hover:bg-blue-300 rounded-lg text-blue-700 ml-4">North</button>
                        </div>
                        <div>
                            <button wire:click.prevent="getArea('S')" class="py-2 px-5 bg-blue-100 hover:bg-blue-300 rounded-lg text-blue-700 ml-4">South</button>
                        </div>
                        <div>
                            <button wire:click.prevent="getArea('E')" class="py-2 px-5 bg-blue-100 hover:bg-blue-300 rounded-lg text-blue-700 ml-4">East</button>
                        </div>
                        <div>
                            <button wire:click.prevent="getArea('W')" class="py-2 px-5 bg-blue-100 hover:bg-blue-300 rounded-lg text-blue-700 ml-4">West</button>
                        </div>
                    </div>
                </div>
                @if($displayArea)
                <div class="py-6">
                    <x-jet-label for="practice_place" value="{{ __('Select A Health Institution') }}" />
                    <select id="place" name="place" wire:model="place" class="block mt-1 w-full form-input rounded-md shadow-sm">
                        <option value=''>Select A Health Institution</option>
                        @forelse($listOfPlaceInArea as $place)
                        <option value={{ $place->id }}>{{ $place->name}}</option>
                        @empty
                        <option value=''>No Health Institution Available</option>
                        @endforelse
                    </select>
                </div>
                @endif
                @if($displayDoctor)
                <div class="py-6">
                    <x-jet-label for="doctor" value="{{ __('Choose a doctor') }}" />
                    <select id="doctor" name="doctor" wire:model="doctor" class="block mt-1 w-full form-input rounded-md shadow-sm">
                        <option value=''>Choose A Doctor</option>
                        @forelse($listOfDoctors as $doctor)
                        <option value={{ $doctor->id }}>{{ $doctor->name . ' - ' . $doctor->specialty}}</option>
                        @empty
                        <option value=''>No Doctor Available</option>
                        @endforelse
                    </select>
                </div>
                @endif
                @if($displayDateTime)
                <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
                <style>
                    [x-cloak] {
                        display: none;
                    }
                </style>
                <div>
                    <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                        <div class="container mx-auto px-4 py-6">
                            <div class="mb-5 flex">
                                <div class="w-1/2">
                                    <label for="selectedDate" class="font-normal mb-1 text-gray-700 block">Select Preferred Date</label>
                                    <div class="relative">
                                        <input type="hidden" name="date" x-ref="date">
                                        <input type="text" id="selectedDate" name="selectedDate" readonly x-model="datepickerValue" @click="showDatepicker = !showDatepicker" @keydown.escape="showDatepicker = false" class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Select date">

                                        <div class="absolute top-0 right-0 px-3 py-2">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>

                                        <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0" style="width: 17rem" x-show.transition="showDatepicker" @click.away="showDatepicker = false">

                                            <div class="flex justify-between items-center mb-2">
                                                <div>
                                                    <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                                                    <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                                                </div>
                                                <div>
                                                    <button type="button" class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" :class="{'cursor-not-allowed opacity-25': month == 0 }" :disabled="month == 0 ? true : false" @click="month--; getNoOfDays()">
                                                        <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full" :class="{'cursor-not-allowed opacity-25': month == 11 }" :disabled="month == 11 ? true : false" @click="month++; getNoOfDays()">
                                                        <svg class="h-6 w-6 text-gray-500 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap mb-3 -mx-1">
                                                <template x-for="(day, index) in DAYS" :key="index">
                                                    <div style="width: 14.26%" class="px-1">
                                                        <div x-text="day" class="text-gray-800 font-medium text-center text-xs"></div>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="flex flex-wrap -mx-1">
                                                <template x-for="blankday in blankdays">
                                                    <div style="width: 14.28%" class="text-center border p-1 border-transparent text-sm"></div>
                                                </template>
                                                <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                                    <div style="width: 14.28%" class="px-1 mb-1">
                                                        <div @click="getDateValue(date)" x-text="date" class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100" :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false}"></div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <x-jet-validation-errors for="" />
                                </div>
                            </div>
                        </div>

                    </div>
                    @if($displayTime)
                    <div class="py-4">
                        <x-jet-label for="time" value="{{ __('Select Preferred Time') }}" />
                        <div class="flex flex-wrap">
                            @foreach($appt_time as $time)
                            <div class="px-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" wire:model="selectedTime" name="radio" value="{{$time}}">
                                    <span class="ml-2">{{$time}}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
                <div class="flex justify-end">
                    @if($displaySubmitButton)
                    <div>
                        <button wire:click="confirmSubmit" wire:loading.attr="disabled">
                            Request Appointment
                        </button>
                        <x-jet-dialog-modal wire:model="confirmingSubmit">
                            <x-slot name="title">
                                {{ __('Confirm Appointment') }}
                            </x-slot>

                            <x-slot name="content">
                                {{ __('Review Appointment Information') }}

                                <div class="mt-4" x-data="{}" x-on:confirming-submit-appt.window="">
                                    <h2>You have selected: </h2>
                                    <div class="py-1">
                                        <p class="font-semibold">
                                            {{'Dr.' . $selectedDoctor->first()->name}}
                                        </p>
                                        <p class="font-semibold">
                                            {{$place->name}}
                                        </p>
                                    </div>
                                    <p class="font-bold py-2">
                                        {{$selectedDate . ' ' . $selectedTime}}
                                    </p>
                                </div>
                            </x-slot>

                            <x-slot name="footer">
                                <x-jet-button class="ml-2" wire:click="submitAppt" wire:loading.attr="disabled">
                                    {{ __('Request Appointment') }}
                                </x-jet-button>
                            </x-slot>
                        </x-jet-dialog-modal>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        function app() {
            return {
                showDatepicker: false,
                datepickerValue: @entangle('selectedDate'),

                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                initDate() {
                    let today = new Date();
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    // this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                },

                isToday(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);

                    return today.toDateString() === d.toDateString() ? true : false;
                },

                pastDate(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);

                    console.log(today > d);
                    return today.toDateString() > d.toDateString() ? true : false;
                },

                getDateValue(date) {
                    let selectedDate = new Date(this.year, this.month, date);
                    this.datepickerValue = selectedDate.toDateString();

                    this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + selectedDate.getMonth()).slice(-2) + "-" + ('0' + selectedDate.getDate()).slice(-2);

                    console.log(this.$refs.date.value);

                    this.showDatepicker = false;
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay();
                    let blankdaysArray = [];
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }

                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                }
            }
        }
    </script>