jQuery(function ($) {
    $('body').on('click', '.filter-box input[type=checkbox]', function () {
        let name = $(this).attr('name');
        let value = $(this).val();
        const url = new URL(window.location);
        let params = '';

        let list = $(`input[name='${name}']:checked`).map(function () {
            return this.value;
        }).get();

        if (!list.length) {
            url.searchParams.delete(name);
            window.history.pushState({}, '', url);
            $('body').trigger('filterchange');
            return;
        }

        if (url.searchParams.get(name)) {
            params = url.searchParams.get(name) + ',' + value;
        } else {
            params = value;
        }

        if (name && value) {
            url.searchParams.set(name, list.join(','));
            window.history.pushState({}, '', url);
        }

        if (!$(this).closest('label').find('.filter-loadresults').length) {
            $(this).closest('label').siblings().find('.filter-loadresults').remove();
            // $(this).closest('label').append('<span class="filter-loadresults">Показати</span>')
        }

        $('body').trigger('filterchange');
    })

    $('body').on('click', '.filter-loadresults', function (e) {
        // e.stopPropagation();
        e.preventDefault();
        e.stopImmediatePropagation();
        console.log('loadresults');
        window.location.reload();
    })

    $('body').on('click', '.choosed-filter span', function () {
        let name = $(this).data('key');
        let value = $(this).data('value').toString();
        const url = new URL(window.location);
        let params = url.searchParams.get(name);

        if (params.includes(',')) {
            params = params.split(',')
        } else {
            params = [params];
        }

        const index = params.indexOf(value);

        if (index > -1) { // only splice array when item is found
            params.splice(index, 1); // 2nd parameter means remove one item only
        }
        console.log(params.length)

        if (params.length === 0) {
            url.searchParams.delete(name);
        } else {
            params = params.join(',');

            url.searchParams.set(name, params);
        }

        window.history.pushState({}, '', url);

        $('body').trigger('filterchange');

        $(this).remove();
    })

    $('body').on('filterchange', function () {
        $('.loader-wrapper').removeClass('hidden');
        let data = {
            action: 'productfilter',
            catid: $('.prod-catalog').data('id'),
            vars: $('.prod-catalog-vars').text(),
            ...Object.fromEntries((new URL(window.location)).searchParams),
        };

        console.log(data)

        jQuery.get('/wp-admin/admin-ajax.php', data, function (response) {
            $('.prod-catalog-row>*').remove();
            $('.prod-catalog-row').append(response.data.data)
        });

        $('.loader-wrapper').addClass('hidden');
    })
})
