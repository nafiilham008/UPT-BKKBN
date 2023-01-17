
<!-- js jumbotron -->

<!-- js Tabs -->
{{-- <script type="text/javascript">
    function changeAtiveTab(event, tabID) {
        let element = event.target;
        while (element.nodeName !== "A") {
            element = element.parentNode;
        }
        ulElement = element.parentNode.parentNode;
        aElements = ulElement.querySelectorAll("li > a");
        tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
        for (let i = 0; i < aElements.length; i++) {
            // aElements[i].classList.remove("text-white");

            // aElements[i].classList.add("text-gray-800");

            aElements[i].classList.remove("border-black");
            aElements[i].classList.remove("border-b-4");
            tabContents[i].classList.add("hidden");
            tabContents[i].classList.remove("block");
        }
        // element.classList.remove("text-white");
        element.classList.add("border-white");
        element.classList.add("border-b-4");
        // element.classList.add("text-white");
        document.getElementById(tabID).classList.remove("hidden");
        document.getElementById(tabID).classList.add("block");
    }
</script> --}}
