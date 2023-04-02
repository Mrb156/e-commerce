<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                 alt="Your Company">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Hozz létre egy új felhasználói
                fiókot</h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="mt-8 space-y-6" method="post" action="/store"
              x-data="{password: '',password_confirm: ''}">
            @csrf
            <input type="hidden" name="remember" value="true">
            <div class="-space-y-px rounded-md shadow-sm">
                <div>
                    <label for="email-address" class="sr-only">Email cím</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required
                           class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           placeholder="Email cím">
                </div>
                <div>
                    <label for="email-address" class="sr-only">Név</label>
                    <input id="name" name="name" type="text" autocomplete="name" required
                           class="relative block w-full border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           placeholder="Teljes név">
                </div>
                <div>
                    <label for="password" class="sr-only">Jelszó</label>
                    <input id="password" name="password" type="password" autocomplete="current-password"
                           x-model="password" required
                           class="relative block w-full border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           placeholder="Jelszó">
                </div>
                <div>
                    <label for="password_confirmation" class="sr-only">Jelszó mégegyszer</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           autocomplete="password_confirmation"
                           x-model="password_confirm" required
                           class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           placeholder="Jelszó mégegyszer">
                </div>
            </div>
            <div class="flex justify-start mt-3 ml-4 p-1">
                <ul>
                    <li class="flex items-center py-1">
                        <div
                            :class="{'bg-green-200 text-green-700': password == password_confirm && password.length > 0, 'bg-red-200 text-red-700':password != password_confirm || password.length == 0}"
                            class=" rounded-full p-1 fill-current ">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="password == password_confirm && password.length > 0"
                                      stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                                <path x-show="password != password_confirm || password.length == 0"
                                      stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>

                            </svg>
                        </div>
                        <span
                            :class="{'text-green-700': password == password_confirm && password.length > 0, 'text-red-700':password != password_confirm || password.length == 0}"
                            class="font-medium text-sm ml-3"
                            x-text="password == password_confirm && password.length > 0 ? 'Passwords match' : 'Passwords do not match' "></span>
                    </li>
                    <li class="flex items-center py-1">
                        <div
                            :class="{'bg-green-200 text-green-700': password.length > 7, 'bg-red-200 text-red-700':password.length <= 7 }"
                            class=" rounded-full p-1 fill-current ">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="password.length > 7"
                                      stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                                <path x-show="password.length <= 7"
                                      stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>

                            </svg>
                        </div>
                        <span :class="{'text-green-700': password.length > 7, 'text-red-700':password.length <= 7 }"
                              class="font-medium text-sm ml-3"
                              x-text="password.length > 7 ? 'The minimum length is reached' : 'At least 8 characters required' "></span>
                    </li>
                </ul>
            </div>

            <div>
                <button type="submit"
                        class="group relative flex w-full justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" viewBox="0 0 20 20" fill="currentColor"
                 aria-hidden="true">
              <path fill-rule="evenodd"
                    d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                    clip-rule="evenodd"/>
            </svg>
          </span>
                    Regisztráció
                </button>
            </div>
        </form>
    </div>
</div>
