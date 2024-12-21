<div>
  <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center items-center">
    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
      <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
        <div>
          <img src="https://umedalife.jp/assets/images/umeda-logo.png" class="w-64 mx-auto" />
        </div>
        <div class="mt-12 flex flex-col items-center">
          <h1 class="text-2xl xl:text-3xl font-extrabold">
            Login
          </h1>

          <div class="w-full flex-1 mt-8">
            <div class="mx-auto max-w-xs">
              <x-form wire:submit="login">
                <x-input wire:model="loginForm.username" label="Username" placeholder="Username" icon-right="o-user"
                  right />
                <x-password wire:model="loginForm.password" label="Password" placeholder="Password"
                  password-icon="o-lock-closed" password-visible-icon="o-lock-open" right />

                <x-button type="submit" spinner="login" class="bg-[#96694C] hover:bg-[#b98766] text-white btn-block">
                  Login
                </x-button>
                <x-errors class="text-white" />
              </x-form>

            </div>
          </div>
        </div>
      </div>
      <div class="flex-1 bg-white text-center hidden lg:flex">
        <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
          style="background-image: url('https://storage.googleapis.com/devitary-image-host.appspot.com/15848031292911696601-undraw_designer_life_w96d.svg');">
        </div>
      </div>
    </div>
  </div>

</div>
