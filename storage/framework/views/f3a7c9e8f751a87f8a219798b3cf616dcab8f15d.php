<div class="w-full flex sm:border-b sm:border-gray-300 relative flex-col sm:flex-row">
    <button class="flex-1 sm:text-center font-medium pb-3 cursor-pointer hover:text-blue-400 false tablink active'" onclick="openPage('Home', this)" id="defaultOpen">
        Internationasdasd
    </button>
    <button class="flex-1 sm:text-center font-medium pb-3 cursor-pointer hover:text-blue-400 false tablink" onclick="openPage('News', this)" id="defaultOpen">
        Local
    </button>
    <!-- <div class="hidden sm:block absolute bottom-0 left-0 h-1 bg-blue-400 transition-transform duration-300 ease-out w-1/2 transform translate-x-double"></div> -->
</div>

<div id="Home" class="tabcontent">
    <h3>Home</h3>
    <p>Home is where the heart is..</p>
</div>

<div id="News" class="tabcontent">
    <h3>news</h3>
    <p>Home is where the heart is..</p>
</div>

<script>
    function openPage(pageName, elmnt) {
        // Hide all elements with class="tabcontent" by default */
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Remove the background color of all tablinks/buttons
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }

        // Show the specific tab content
        document.getElementById(pageName).style.display = "block";

        // Add the specific color to the button used to open the tab content
        elmnt.style.borderColor = "white";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script><?php /**PATH /Users/jasonng/Desktop/SaveTrace/resources/views/livewire/doctor-referrals-tabs.blade.php ENDPATH**/ ?>