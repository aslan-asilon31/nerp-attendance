<div>

<div class="swiper mySwiper">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <div class="swiper-slide">
        <img src="https://www.ufoelektronika.com/index.php?route=product/search&search=matras" alt="Matras" />
    </div>
    <div class="swiper-slide">
        <img src="https://www.ufoelektronika.com/image/cache/catalog/18%20Okt%2024/Artugo-Web-Banner-1700-x-806-px-1050x505.png" alt="Artugo Web Banner" />
    </div>
    <div class="swiper-slide">
        <img src="https://www.ufoelektronika.com/pengundian-gebyar-undian-ufo-total-hadiah-milyaran-rupiah" alt="Pengundian UFO" />
    </div>
  </div>

  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

  <!-- If we need scrollbar -->
  <div class="swiper-scrollbar"></div>
</div>

<!-- Swiper JS initialization -->
<script>
  var swiper = new Swiper('.mySwiper', {
    loop: true, // Enable continuous loop mode
    autoplay: {
      delay: 2500, // Time between slides (in ms)
      disableOnInteraction: false, // Allow autoplay to continue after interaction
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true, // Make pagination clickable
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });
</script>


<hr>

<div class="flex flex-wrap justify-between gap-4">
    <div class="flex-shrink-0 w-full sm:w-1/3 md:w-1/4 p-4 m-4 justify-between  ">
        <div class="flex gap-4 justify-between  bg-orange-500  overflow-hidden">
            <a href="" class="text-center text-xs">
             <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/holiday-cuti.png')}}" alt="Card 2">
             <span class="text-center text-xs">Leave</span>
            </a>
            <a href="" class="text-center text-xs">
                <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/permit-izin.png')}}" alt="Card 2">
                <span class="text-center text-xs">Permission</span>
            </a>
            <a href="" class="text-center text-xs">
                <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/tugas-luar.png')}}" alt="Card 3">
                <span class="text-center text-xs">Out-of-Office Task</span>
            </a>
            <a href="" class="text-center text-xs">
                <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/work-in-holiday.png')}}" alt="Card 4">
                <span class="text-center text-xs">Task on Public Holiday</span>
            </a>
            <a href="" class="text-center text-xs">
                <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/work-overtime.png')}}" alt="Card 4">
                <span class="text-center text-xs">Overtime</span>
            </a>
        </div>
    </div>
</div>


<div class="flex flex-wrap justify-between gap-4">
    <div class="flex-shrink-0 w-full sm:w-1/3 md:w-1/4 p-4 justify-between  ">
        <div class="flex gap-4 justify-between  bg-orange-500 rounded-lg shadow-lg overflow-hidden">
            <a href="" class="text-center text-xs">
                <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/absensi.png')}}" alt="Card 4">
                <span class="text-center text-xs">Attendance</span>
            </a>
            <a href="" class="text-center text-xs">
                <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/rekap-absensi.png')}}" alt="Card 4">
                <span class="text-center text-xs">Attendance Summary</span>
            </a>
            <a href="" class="text-center text-xs">
                <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/rekap-kegiatan.png')}}" alt="Card 4">
                <span class="text-center text-xs">Activity Summary</span>
            </a>
            <a href="" class="text-center text-xs">
                <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/absensi.png')}}" alt="Card 4">
                <span class="text-center text-xs">Pay Slip</span>
            </a>
            <a href="" class="text-center text-xs">
                <img class="w-full h-16 sm:h-16 md:w-24 lg:32 object-cover rounded-t-lg" style="" src="{{asset('asset-ui/icon-attendance/absensi.png')}}" alt="Card 4">
                <span class="text-center text-xs">Others</span>
            </a>
        </div>
    </div>
</div>


</div>