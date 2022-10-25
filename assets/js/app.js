document.addEventListener("DOMContentLoaded", function() {
    $('.mega-sub-menu .back').on('click', function (e){
        e.stopPropagation();
        $(this).parent('.mega-sub-menu').removeClass('active');
    })
    $(".menu-btn").on("click", function(){
        $('body').toggleClass('fixed')
        $('nav.menu').toggleClass('active');
    })


    var prevScrollpos = window.pageYOffset;

    /* Get the header element and it's position */
    var headerDiv = document.querySelector("header.header");
    var headerBottom = headerDiv.offsetTop + headerDiv.offsetHeight;

    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;

        /* if we're scrolling up, or we haven't passed the header,
           show the header at the top */
        if (prevScrollpos > currentScrollPos  || currentScrollPos < headerBottom){
            headerDiv.style.top = "0";
        }
        else{
            /* otherwise we're scrolling down & have passed the header so hide it */
            headerDiv.style.top = "-192px";
        }

        prevScrollpos = currentScrollPos;
    }
    function windowSize(){
        if ($(window).width() <= '992'){
                $('.collapse').readmore({
                    speed: 75,
                    moreLink: '<a href="#">See More</a>',
                    collapsedHeight: 89
                });
                $('.filt-btn').on('click', function (){
                    $('.filter').toggleClass('active');
                });
            $(".mega-menu-item-has-children a").on('click', function(e){
                e.stopPropagation()
                e.preventDefault();
                $(this).parent().children(".mega-sub-menu").toggleClass('active');
            });

            $(".header.header nav.menu ul#mega-menu-primary>li>.mega-sub-menu").prepend('<div class="back"><span>Назад</span></div>');
            $('header.header nav.menu ul#mega-menu-primary>li>.mega-sub-menu .mega-menu-row .bruise>ul>li>a').on("click", function (){
                $(this).toggleClass("active")
                $(this).parent().siblings().removeClass("active");
            })
            $('.back').on('click', function (){
                $(this).parent().removeClass('active')
            })
            $('.tabs').addClass('swiper');
            $('.tab-inn').addClass('swiper-wrapper')
            $('.tab').addClass('swiper-slide')
            $('.lang-mob li.wpml-ls-current-language a').on("click", function (e){
                e.stopPropagation()
               e.preventDefault();
               $('.lang-mob li:not(.wpml-ls-current-language)').show();
               $('*:not(.lang-mob li a)').on("click", function (){
                   $('.lang-mob li:not(.wpml-ls-current-language)').hide();
               })
            })
            const swiper = new Swiper('.swiper', {
                // Default parameters
                slidesPerView: 1,
                spaceBetween: 10,
                // Responsive breakpoints
                allowTouchMove: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            })
            $('.toblock').removeClass('active')

        } else {

            $('.collapse').readmore('destroy');
            $('.tabs').removeClass('swiper');
            $('.tab-inn').removeClass('swiper-wrapper');
            $('.tab').removeClass('swiper-slide');
            $(".mega-sub-menu").mouseleave(function(e){
                // e.stopPropagation(e);
                $(this).removeClass('active');
                $('body').removeClass('fixed')
            });
            $(".mega-sub-menu").mouseover(function(e){
                // e.stopPropagation(e);
                $(this).addClass('active');
                $('body').addClass('fixed')
            });
            $("#mega-menu-primary > .mega-menu-item-has-children > a").mouseover(function(e){
                e.stopPropagation();
                $(this).siblings(".mega-sub-menu").addClass('active');
            });
            $('#mega-menu-primary > .mega-menu-item-has-children > a').mouseleave(function(e){
                e.stopPropagation();
                $(this).siblings('.mega-sub-menu').removeClass('active');
            });
            $('.tabs .tab:nth-of-type(1)').addClass('active');
        }
    }

    $('.modal-open').on('click', function(e){
        e.preventDefault();
        $('.modal').addClass('open');
        $('body').addClass('fixed');
    });
    $('.modal .bg').on('click', function(){
        $('.modal').removeClass('open');
        $('body').removeClass('fixed');
    });
    $('.modal .close').on('click', function(){
        $('.modal').removeClass('open');
        $('body').removeClass('fixed');
    });
    $(window).on('load resize',windowSize);
    $('.tabs > ul').on('click', 'li:not(.active)', function() {
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('.tabs').find('.tab').removeClass('active').eq($(this).index()).addClass('active');
    });
    $('.clicker').on('click', function() {
        $(this).addClass('active');
        $(this).parent().siblings().find('.clicker').removeClass('active');
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
    });
    $('#listings').on('click', '.item:not(.active)', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this)
            .addClass('active').siblings().removeClass('active')
            .closest('.container').find('.toblock').removeClass('active').eq($(this).index()).addClass('active');
    });
    lightbox.option({
        'resizeDuration': 200,
        'disableScrolling': true,
        'fitImagesInViewport': true
    })
});



// if($('.mapper').length > 0) {
//     mapboxgl.accessToken = 'pk.eyJ1IjoiY2ljZXJvYWdlbnR1ciIsImEiOiJja2lyOTBuOXYwOGJ5MnhzY2kyMXRocG9nIn0.fYRg2TLIuWCaZuxVjhsadg';
//
//     /**
//      * Add the map to the page
//      */
//     const map = new mapboxgl.Map({
//         container: 'map',
//         style: 'mapbox://styles/mapbox/streets-v11',
//         center: [30.561570, 50.467682],
//         zoom: 10,
//         scrollZoom: true
//     });
//     map.addControl(new mapboxgl.NavigationControl());
//     const stores = {
//         'type': 'FeatureCollection',
//
//         'features': [
//             {
//                 'type': 'Feature',
//                 'geometry': {
//                     'type': 'Point',
//                     'coordinates': [30.550097957743052, 50.3794718032645]
//                 },
//                 'properties': {
//                     'city': 'Київ',
//                     'name': 'Київ (Центральний офіс)',
//                     'street': '03083 вул. Пирогівський Шлях, 32',
//                     'phone': '044-537-06-44',
//
//                 }
//             },
//             {
//                 'type': 'Feature',
//                 'geometry': {
//                     'type': 'Point',
//                     'coordinates': [32.06219071540986, 46.94399447196801]
//                 },
//                 'properties': {
//                     'city': 'Миколаїв',
//                     'name': 'Миколаїв',
//                     'street': '3083 вул. Пирогівський Шлях, 32',
//                     'phone': '044-537-06-44',
//
//                 }
//             },
//             {
//                 'type': 'Feature',
//                 'geometry': {
//                     'type': 'Point',
//                     'coordinates': [24.08669629999671, 49.88522054669058]
//                 },
//                 'properties': {
//                     'city': 'Львів',
//                     'name': 'Львів',
//                     'street': '3083 вул. Пирогівський Шлях, 32',
//                     'phone': '044-537-06-44',
//
//                 }
//             }
//         ]
//     };
//
//     /**
//      * Assign a unique id to each store. You'll use this `id`
//      * later to associate each point on the map with a listing
//      * in the sidebar.
//      */
//     stores.features.forEach((store, i) => {
//         store.properties.id = i;
//     });
//
//     /**
//      * Wait until the map loads to make changes to the map.
//      */
//     map.on('load', () => {
//         /**
//          * This is where your '.addLayer()' used to be, instead
//          * add only the source without styling a layer
//          */
//         map.addSource('places', {
//             'type': 'geojson',
//             'data': stores
//         });
//
//         /**
//          * Add all the things to the page:
//          * - The location listings on the side of the page
//          * - The markers onto the map
//          */
//         buildLocationList(stores);
//         addMarkers();
//     });
//
//     /**
//      * Add a marker to the map for every store listing.
//      **/
//     function addMarkers() {
//         /* For each feature in the GeoJSON object above: */
//         for (const marker of stores.features) {
//             /* Create a div element for the marker. */
//             const el = document.createElement('div');
//             /* Assign a unique `id` to the marker. */
//             el.id = `marker-${marker.properties.id}`;
//             /* Assign the `marker` class to each marker for styling. */
//             el.className = 'marker';
//
//             /**
//              * Create a marker using the div element
//              * defined above and add it to the map.
//              **/
//             new mapboxgl.Marker(el, {offset: [0, -23]})
//                 .setLngLat(marker.geometry.coordinates)
//                 .addTo(map);
//
//             /**
//              * Listen to the element and when it is clicked, do three things:
//              * 1. Fly to the point
//              * 2. Close all other popups and display popup for clicked store
//              * 3. Highlight listing in sidebar (and remove highlight for all other listings)
//              **/
//             el.addEventListener('click', (e) => {
//                 /* Fly to the point */
//                 flyToStore(marker);
//                 /* Close all other popups and display popup for clicked store */
//                 createPopUp(marker);
//                 /* Highlight listing in sidebar */
//                 const activeItem = document.getElementsByClassName('active');
//                 e.stopPropagation();
//                 if (activeItem[0]) {
//                     activeItem[0].classList.remove('active');
//                 }
//                 const listing = document.getElementById(
//                     `listing-${marker.properties.id}`
//                 );
//                 listing.classList.add('active');
//             });
//         }
//     }
//
//     /**
//      * Add a listing for each store to the sidebar.
//      **/
//     function buildLocationList(stores) {
//         for (const store of stores.features) {
//             /* Add a new listing section to the sidebar. */
//             const listings = document.getElementById('listings');
//             const actlist = document.getElementById('sidebar');
//             const listing = listings.appendChild(document.createElement('div'));
//             /* Assign a unique `id` to the listing. */
//             listing.id = `listing-${store.properties.id}`;
//             /* Assign the `item` class to each listing for styling. */
//             listing.className = 'item col-lg-3';
//
//             /* Add the link to the individual listing created above. */
//             const link = listing.appendChild(document.createElement('a'));
//             link.href = '#';
//             link.className = 'title';
//             link.id = `link-${store.properties.id}`;
//             link.innerHTML = `${store.properties.city}`;
//
//             /* Add details to the individual listing. */
//             // const details = actlist.appendChild(document.createElement('div'));
//             // details.innerHTML = `<p>${store.properties.street}</p>
//             // <p>${store.properties.plz}</p
//             // <p>${store.properties.city}</p>`;
//
//
//             /**
//              * Listen to the element and when it is clicked, do four things:
//              * 1. Update the `currentFeature` to the store associated with the clicked link
//              * 2. Fly to the point
//              * 3. Close all other popups and display popup for clicked store
//              * 4. Highlight listing in sidebar (and remove highlight for all other listings)
//              **/
//             link.addEventListener('click', function (e) {
//                 e.preventDefault()
//                 for (const feature of stores.features) {
//                     if (this.id === `link-${feature.properties.id}`) {
//                         flyToStore(feature);
//                         createPopUp(feature);
//                         actlist.appendChild(document.createElement('div'));
//                         actlist.innerHTML = `<div class="title">${store.properties.name}</div>
//                     <div><b>Адреса: </b>${store.properties.street}</div>
//                     <div><b>Телефон: </b>${store.properties.phone}</div>`;
//                     }
//                 }
//                 const activeItem = document.getElementsByClassName('active');
//                 if (activeItem[0]) {
//                     activeItem[0].classList.remove('active');
//                 }
//                 this.parentNode.classList.add('active');
//             });
//         }
//     }
//
//     /**
//      * Use Mapbox GL JS's `flyTo` to move the camera smoothly
//      * a given center point.
//      **/
//     function flyToStore(currentFeature) {
//         map.flyTo({
//             center: currentFeature.geometry.coordinates,
//             zoom: 15
//         });
//     }
//
//     /**
//      * Create a Mapbox GL JS `Popup`.
//      **/
//     function createPopUp(currentFeature) {
//
//     }
//
//
// // const geocoder = new MapboxGeocoder({
// //     // Initialize the geocoder
// //     accessToken: mapboxgl.accessToken, // Set the access token
// //     mapboxgl: mapboxgl, // Set the mapbox-gl instance
// //     marker: false, // Do not use the default marker style
// //     placeholder: 'Search for places in Berkeley', // Placeholder text for the search bar
// //     bbox: [6.441593,47.458186,14.919434,54.762621], // Boundary for Germany
// //     proximity: {
// //         longitude: 8.648086,
// //         latitude: 50.107011
// //     } // Coordinates of UC Berkeley
// // });
//
// // Add the geocoder to the map
// // map.addControl(geocoder);
//
// // After the map style has loaded on the page,
// // add a source layer and default styling for a single point
//     map.on('load', () => {
//         map.addSource('single-point', {
//             'type': 'geojson',
//             'data': {
//                 'type': 'FeatureCollection',
//                 'features': []
//             }
//         });
//
//         map.addLayer({
//             'id': 'point',
//             'source': 'single-point',
//             'type': 'circle',
//             'paint': {
//                 'circle-radius': 10,
//                 'circle-color': '#448ee4'
//             }
//         });
//
//         // Listen for the `result` event from the Geocoder // `result` event is triggered when a user makes a selection
//         //  Add a marker at the result's coordinates
//         geocoder.on('result', (event) => {
//             map.getSource('single-point').setData(event.result.geometry);
//         });
//     });
//
// }