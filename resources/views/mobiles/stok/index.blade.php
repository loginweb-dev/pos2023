<ons-page>
    <ons-toolbar>
        <div class="left">
            <ons-toolbar-button icon="md-face" style="color: green;"></ons-toolbar-button>
        </div>
        <div class="center">Marketplace @2023</div>
    </ons-toolbar>
  
    <ons-tabbar swipeable position="auto">
        <ons-tab page="tab1.html" label="Tab 1" icon="ion-ios-home, material:md-home" badge="0" active>
        </ons-tab>
        <ons-tab page="tab2.html" label="Tab 2" icon="md-settings" active-icon="md-face">
        </ons-tab>
        <ons-tab page="tab3.html" label="Tab 3" icon="md-settings" active-icon="md-face">
        </ons-tab>
    </ons-tabbar>
</ons-page>
  
  <template id="tab1.html">
    <ons-page id="Tab1">
      <ons-carousel swipeable auto-scroll overscrollable id="carousel">
        <ons-carousel-item>
          <img src="{{ asset('app/appbanner2.jpg') }}" alt="" style="width: 100%; height: 120px;">
        </ons-carousel-item>
        <ons-carousel-item>
          <img src="{{ asset('app/banner1.jpg') }}" alt="" style="width: 100%; height: 120px;">
        </ons-carousel-item>
        <ons-carousel-item style="background-color: #D38312;">
          <ons-carousel-item>
            <img src="{{ asset('app/banner3.jpg') }}" alt="" style="width: 100%; height: 120px;">
          </ons-carousel-item>
        </ons-carousel-item>
      </ons-carousel>
      <ons-list>
        <ons-list-header>Restaurantes y Comida Rapida</ons-list-header>
        <ons-list-item modifier="chevron" tappable>
          <div class="left">
            <img class="list-item__thumbnail" src="https://placekitten.com/g/40/40">
          </div>
          <div class="center">
            <span class="list-item__title">Cutest kitty</span><span class="list-item__subtitle">On the Internet</span>
          </div>
        </ons-list-item>
      </ons-list>
      <ons-button id="push-button">Push page</ons-button>
    </ons-page>
  </template>
  
  <template id="tab2.html">
    <ons-page id="Tab2">
        <ons-card>
            <img src="https://monaca.io/img/logos/download_image_onsenui_01.png" alt="Onsen UI" style="width: 100%">
            <div class="title">
              Awesome framework
            </div>
            <div class="content">
              {{-- <div>
                <ons-button><ons-icon icon="ion-ios-thumbs-up"></ons-icon></ons-button>
                <ons-button><ons-icon icon="ion-ios-share"></ons-icon></ons-button>
              </div> --}}
              {{-- <ons-list>
                <ons-list-header>Bindings</ons-list-header>
                <ons-list-item>Vue</ons-list-item>
                <ons-list-item>Angular</ons-list-item>
                <ons-list-item>React</ons-list-item>
              </ons-list> --}}
            </div>
        </ons-card>
    </ons-page>
  </template>

  <template id="tab3.html">
    <ons-page id="Tab3">
      {{-- <ons-toolbar>
        <div class="left">
          <ons-toolbar-button onclick="prev()">
            <ons-icon icon="md-chevron-left"></ons-icon>
          </ons-toolbar-button>
        </div>
        <div class="center">Carousel</div>
        <div class="right">
          <ons-toolbar-button onclick="next()">
            <ons-icon icon="md-chevron-right"></ons-icon>
          </ons-toolbar-button>
        </div>
      </ons-toolbar> --}}

      <ons-carousel swipeable auto-scroll overscrollable id="carousel">
        <ons-carousel-item style="background-color: #085078;">
          <img src="{{ asset('app/appbanner2.jpg') }}" alt="" style="width: 100%">
        </ons-carousel-item>
        <ons-carousel-item style="background-color: #373B44;">
          <div style="text-align: center; font-size: 30px; margin-top: 20px; color: #fff;">
            DARK
          </div>
        </ons-carousel-item>
        <ons-carousel-item style="background-color: #D38312;">
          <div style="text-align: center; font-size: 30px; margin-top: 20px; color: #fff;">
            ORANGE
          </div>
        </ons-carousel-item>
      </ons-carousel>
    </ons-page>
  </template>

  <template id="negocio.html">
    <ons-page id="negocio">
      <ons-toolbar>
        <div class="center">negocio 1</div>
      </ons-toolbar>
  
      <p>This is the first page.</p>
  
  
    </ons-page>
  </template>

  <script>
    document.addEventListener('prechange', function(event) {
        document.querySelector('ons-toolbar .center')
        .innerHTML = event.tabItem.getAttribute('label');

        page.querySelector('#push-button').onclick = function() {

        };
    });

    document.addEventListener('init', function(event) {
      var page = event.target;
      document.querySelector('#myNavigator').pushPage('negocio.html', {data: {title: 'Page 2'}});

    });
</script>