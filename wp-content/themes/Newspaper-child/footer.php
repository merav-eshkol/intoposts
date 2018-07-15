<!-- Instagram -->

<?php if (td_util::get_option('tds_footer_instagram') == 'show') { ?>

    <div class="td-main-content-wrap td-footer-instagram-container td-container-wrap <?php echo td_util::get_option('td_full_footer_instagram'); ?>">
        <?php
        //get the instagram id from the panel
        $tds_footer_instagram_id = td_instagram::strip_instagram_user(td_util::get_option('tds_footer_instagram_id'));
        ?>

        <div class="td-instagram-user">
            <h4 class="td-footer-instagram-title">
                <?php echo  __td('Follow us on Instagram', TD_THEME_NAME); ?>
                <a class="td-footer-instagram-user-link" href="https://www.instagram.com/<?php echo $tds_footer_instagram_id ?>" target="_blank">@<?php echo $tds_footer_instagram_id ?></a>
            </h4>
        </div>

        <?php
        //get the other panel seetings
        $tds_footer_instagram_nr_of_row_images = intval(td_util::get_option('tds_footer_instagram_on_row_images_number'));
        $tds_footer_instagram_nr_of_rows = intval(td_util::get_option('tds_footer_instagram_rows_number'));
        $tds_footer_instagram_img_gap = td_util::get_option('tds_footer_instagram_image_gap');
        $tds_footer_instagram_header = td_util::get_option('tds_footer_instagram_header_section');

        //show the insta block
        echo td_global_blocks::get_instance('td_block_instagram')->render(
            array(
                'instagram_id' => $tds_footer_instagram_id,
                'instagram_header' => /*td_util::get_option('tds_footer_instagram_header_section')*/ 1,
                'instagram_images_per_row' => $tds_footer_instagram_nr_of_row_images,
                'instagram_number_of_rows' => $tds_footer_instagram_nr_of_rows,
                'instagram_margin' => $tds_footer_instagram_img_gap
            )
        );

        ?>
    </div>

<?php } ?>

<?php

$tds_footer_page = td_util::get_option('tds_footer_page');
$footer_page = null;

if ($tds_footer_page !== '' && intval($tds_footer_page) !== get_the_ID()) {
	$footer_page = get_post( $tds_footer_page );
}

if ( $footer_page instanceof WP_Post ) {

	?>

	<div class="td-footer-wrapper td-footer-page td-container-wrap">
	<?php

		// This action must be removed, because it's added by TagDiv Composer, and it affects footers with custom content
		remove_action( 'the_content', 'tdc_on_the_content', 10000 );

		$content = apply_filters( 'the_content', $footer_page->post_content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		echo $content;

		wp_reset_query();

	?>
	</div>

<?php

} else { ?>


	<!-- Footer -->
	<?php
	if ( td_util::get_option( 'tds_footer' ) != 'no' ) {
		td_api_footer_template::_helper_show_footer();
	}
	?>

	<!-- Sub Footer -->
	<?php
	if ( td_util::get_option( 'tds_sub_footer' ) != 'no' ) {
		td_api_sub_footer_template::_helper_show_sub_footer();
	}
}
?>


</div><!--close td-outer-wrap-->

<?php wp_footer(); ?>

<!-- Tracking -->
<script type="text/javascript">
    var __storage = {
        set: function (key, value) {
            try {
                return localStorage.setItem(key, JSON.stringify(value));
            } catch (e) {
                console.log('Cannot use local storage:', e);
            }
        },

        /**
         * this method return object value by its key
         * @param key
         * @returns {boolean}
         */
        get: function (key) {
            try {
                return JSON.parse(localStorage.getItem(key));
            } catch (e) {
                return false;
            }
        }
    };

    window.addEventListener('DOMContentLoaded', function () {
        function hasClass(el, className) {
            return el.classList ? el.classList.contains(className) : new RegExp('\\b' + className + '\\b').test(el.className);
        }

        function addClass(el, className) {
            if (el.classList) el.classList.add(className);
            else if (!hasClass(el, className)) el.className += ' ' + className;
        }

        function removeClass(el, className) {
            if (el.classList) el.classList.remove(className);
            else el.className = el.className.replace(new RegExp('\\b' + className + '\\b', 'g'), '');
        }

        function getTrackingData() {
            var data = __storage.get('tracking_params');
            if (data) {
                return data;
            } else if (window.location.search) {
                data = {};
                var url_string = window.location.href;
                var url = new URL(url_string);
                var trackingParams = ['click_id', 'destination', 'traffic_source', 'tid', 'zone', 'position', 'publisher', 'campaign'];
                for (i in trackingParams) {
                    if (url.searchParams.get(trackingParams[i])) {
                        data[trackingParams[i]] = url.searchParams.get(trackingParams[i]);
                    }
                }
                return data;
            }
            return {};
        }

        function getSid(target) {
            var trackingData = getTrackingData();//getTrackingParameters();//getTrackingData();
            var sidValue = (typeof(target) !== 'undefined' ? target : 'banner') + '_' + trackingData.zone + '_' + trackingData.traffic_source + '_' + trackingData.post_id;

            //if ((typeof(target.searchParams) !== 'undefined') && (typeof(target.searchParams.get('sid')) !== 'undefined')) { //http://www2.intoposts.com/?s=0menu-text-link
            //if ((typeof(target.searchParams) == 'undefined') || (typeof(target.searchParams.get('sid')) == 'undefined')) { //http://www2.intoposts.com/?s=0&sid=menu-text-link_undefined_undefined_undefined
            //if (typeof(trackingData.sid) == 'undefined') { //http://www2.intoposts.com/?s=0&sid=menu-text-link_undefined_undefined_undefined
            //if (typeof(trackingData.sid) != 'undefined') { //http://www2.intoposts.com/?s=0menu-text-link
            //if (typeof(target.searchParams.get('sid')) !== 'undefined') {
           
            if (Object.getOwnPropertyNames(trackingData).length === 0) {//Merav
            	return '';//'&sid=' + sidValue;
            }
            else
                return '?sid=' + sidValue;//target;

        }
        
        function getOfferUrl() {
            var url = 'https://www.intoposts.com/redirect';
            if (window.location.search) {
                url = 'https://tracking.perfecttoolmedia.com/process?' + getTrackingParameters() + '&direct=1' + getSid('text_link');
                var urlObj = new URL(url);
                urlObj.searchParams.set('sid', getSid('text_link').replace('&sid=', ''));
                url = decodeURIComponent(urlObj.href);
            } else if (__storage.get('tracking_params')) {
                var params = buildParams(__storage.get('tracking_params'));
                if (params[0] === '&') {
                    params = params.substr('1', params.length);
                }
                url = 'https://tracking.perfecttoolmedia.com/process?' + params + getSid('text_link');
            }
            return url.replace('??', '?');
        }

        function getTrackingParameters() {
            var dataObj = {};
            var trackingParams = ['click_id', 'destination', 'traffic_source', 'tid', 'zone', 'position', 'publisher', 'campaign'];
            if (window.location.search) {
                var urlObj = new URL(window.location.href);
                for (i in trackingParams) {
                    if (urlObj.searchParams.get(trackingParams[i])) {
                        dataObj[trackingParams[i]] = urlObj.searchParams.get(trackingParams[i]);
                    }
                }
                storeStorage(dataObj);
            } else if (__storage.get('tracking_params')) {
                dataObj = __storage.get('tracking_params');
            }
            return buildParams(dataObj);
        }

        function buildParams(data) {
            var parameters = '?';
            for (i in data) {
                parameters += i + '=' + data[i] + '&';
            }
            return parameters.substr(0, parameters.length - 1);
        }

        function storeStorage(dataObj) {
            if (__storage.get('tracking_params')) {
                return false;
            }
            __storage.set('tracking_params', dataObj);
        }

        function setLink(selector, action, isOffer) {
            var sideLinks = document.querySelectorAll(selector);
            var param = '';
            if (window.location.search) {
				//Merav
            	var url_string = window.location.href
            	var url = new URL(url_string);
            	var s = url.searchParams.get("s");
            	
                if (typeof(s) !== 'undefined')
                	param = getSid(action);
                else
                	param = window.location.search + getSid(action);
				//Merav
                //param = window.location.search + getSid(action);
            }
            

            for (var i in sideLinks) {
                if (sideLinks[i].nodeName !== 'A') {
                    continue;
                }
                var link = sideLinks[i].getAttribute('href').split('?')[0];
                link += param;
                if (isOffer) {
                    sideLinks[i].setAttribute('target', 'blank');

                    //Merav
                    	if (getTrackingParameters().length == 0)
                    		sideLinks[i].href = link;
                    	else
                    		sideLinks[i].href = link + getTrackingParameters();

                    	//sideLinks[i].href = getOfferUrl();
                    //Merav	
                    setGAEvent(sideLinks[i], selector);
                } else {
                    sideLinks[i].href = link + getTrackingParameters();
                }
            }
        }

        function setGAEvent(element, selector) {
            var linkName = selector === '.tracker' ? 'text_link' : 'banner';
            element.addEventListener('click', function () {
                dataLayer.push({
                    event: 'GTM_TO_GA',
                    GA_event_action: 'Link Click',
                    GA_event_category: 'External Link Click',
                    GA_event_label: 'sid_value: ' + getSid(linkName),
                    GA_event_value: '1'
                });
            });
        }

        function setSocialLink(selector, action) {
            var links = document.querySelectorAll(selector);
            for (var i in links) {
                if (links[i].nodeName !== 'A') {
                    continue;
                }
                link = links[i].getAttribute('href') + encodeURIComponent((getSid().replace('&', '?')) + '&social_source=' + action);
                links[i].href = link;
            }
        }

        setLink('.entry-title a', 'side-text-link', false);
        setLink('.td-post-next-prev a', 'prev-next-text-link', false);
        setLink('.td-read-more a', 'prev-next-text-link', false);
        setLink('#td-header-menu a', 'menu-text-link', false);

        setSocialLink('a.td-social-facebook', 'social_facebook');
        setSocialLink('a.td-social-google', 'social_google');
        setSocialLink('a.td-social-pintrest', 'social_pintrest');
        setSocialLink('a.td-social-twitter', 'social_twitter');

        setLink('.tracker', 'text-link', true);
        setLink('.top10', 'text-link', false);
        setLink('.sidebar-banner', 'banner', true);
        setLink('.td-big-grid-post a', 'text-link', false);

    });
</script>
<!-- Google Tag Manager -->
<script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MH7DC65');</script>
    <!-- End Google Tag Manager -->
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MH7DC65"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W9GP6GZ"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</script> 

</body>
</html>