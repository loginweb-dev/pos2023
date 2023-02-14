@php
    $negocio = App\Business::where("id", 2)->with("owner")->first();
    $productos = App\Product::where("business_id", 2)->where("type", "combo")->get();
@endphp

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
  <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
  <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
  <script src="https://unpkg.com/jquery/dist/jquery.min.js"></script>
</head>
<body>
   
  <ons-navigator id="appNavigator" swipeable swipe-target-width="80px">
    <ons-page>
      <ons-splitter id="appSplitter">
        <ons-splitter-content page="tabbar.html"></ons-splitter-content>
      </ons-splitter>
    </ons-page>
  </ons-navigator>
  
  <template id="tabbar.html">
    <ons-page id="tabbar-page">
      <ons-toolbar>
        <div class="center">{{ $negocio->name }}</div>
      </ons-toolbar>
      <ons-tabbar swipeable id="appTabbar" position="auto">
        <ons-tab label="Inicio" icon="ion-ios-home" page="home.html" active></ons-tab>
        <ons-tab label="Carrito" icon="ion-ios-cart" page="forms.html"></ons-tab>
        <ons-tab label="Perfil" icon="ion-ios-contact" page="animations.html"></ons-tab>
      </ons-tabbar>
  
      <script>
        ons.getScriptPage().addEventListener('prechange', function(event) {
          if (event.target.matches('#appTabbar')) {
            event.currentTarget.querySelector('ons-toolbar .center').innerHTML = event.tabItem.getAttribute('label');
          }
        });
      </script>
    </ons-page>
  </template>

  
  <template id="home.html">
    <ons-page>
      <ons-carousel swipeable auto-scroll overscrollable id="carousel">
        <ons-carousel-item>
          <img src="{{ asset('app/appbanner2.jpg') }}" alt="" style="width: 100%; height: 120px;">
        </ons-carousel-item>
        <ons-carousel-item>
          <img src="{{ asset('app/banner1.jpg') }}" alt="" style="width: 100%; height: 120px;">
        </ons-carousel-item>
        <ons-carousel-item>
          <ons-carousel-item>
            <img src="{{ asset('app/banner3.jpg') }}" alt="" style="width: 100%; height: 120px;">
          </ons-carousel-item>
        </ons-carousel-item>
      </ons-carousel>

      @foreach ($productos as $item)          
        <ons-card onclick="fn.pushPage({'id': 'negocio.html', 'title': '{{ $item->name }}'})">
        <ons-row>
          <ons-col width="50px">
            <img class="list-item__thumbnail" src="{{ asset('uploads/img/'.$item->image) }}">
          </ons-col>
          <ons-col>
            <div class="title">{{ $item->name }} <span class="notification notification--material">{{ $item->id }}</span></div>
            <div class="content">{!! $item->product_description !!}</div>
          </ons-col>
        </ons-row>
        </ons-card>
      @endforeach
  
      <style>
        .intro {
          text-align: center;
          padding: 0 20px;
          margin-top: 40px;
        }
  
        ons-card {
          cursor: pointer;
          color: #333;
        }
  
        .card__title,
        .card--material__title {
          font-size: 20px;
        }
      </style>
    </ons-page>
  </template>
  
  <template id="forms.html">
    <ons-page id="forms-page">
      <ons-list>
        <ons-list-header>Text input</ons-list-header>
        <ons-list-item class="input-items">
          <div class="left">
            <ons-icon icon="md-face" class="list-item__icon"></ons-icon>
          </div>
          <label class="center">
            <ons-input id="name-input" float maxlength="20" placeholder="Name"></ons-input>
          </label>
        </ons-list-item>
      </ons-list>
  
      <script>
        ons.getScriptPage().onInit = function () {
          if (ons.platform.isAndroid()) {
            const inputItems = document.querySelectorAll('.input-items');
            for (i = 0; i < inputItems.length; i++) {
              inputItems[i].hasAttribute('modifier') ?
                inputItems[i].setAttribute('modifier', inputItems[i].getAttribute('modifier') + ' nodivider') :
                inputItems[i].setAttribute('modifier', 'nodivider');
            }
          }
          var nameInput = document.getElementById('name-input');
          var searchInput = document.getElementById('search-input');
          var updateInputs = function (event) {
            nameInput.value = event.target.value;
            searchInput.value = event.target.value;
            document.getElementById('name-display').innerHTML = event.target.value !== '' ? `Hello ${event.target.value}!` : 'Hello anonymous!';
          }
          nameInput.addEventListener('input', updateInputs);
          searchInput.addEventListener('input', updateInputs);
          document.getElementById('model-switch').addEventListener('change', function (event) {
            if (event.value) {
              document.getElementById('switch-status').innerHTML = `&nbsp;(on)`;
              document.getElementById('enabled-label').innerHTML = `Enabled switch`;
              document.getElementById('disabled-switch').disabled = false;
            } else {
              document.getElementById('switch-status').innerHTML = `&nbsp;(off)`;
              document.getElementById('enabled-label').innerHTML = `Disabled switch`;
              document.getElementById('disabled-switch').disabled = true;
            }
          });
          document.getElementById('select-input').addEventListener('change', function (event) {
            document.getElementById('awesome-platform').innerHTML = `${event.target.value}&nbsp;`;
          });
          var currentFruitId = 'radio-1';
          const radios = document.querySelectorAll('.radio-fruit')
          for (var i = 0; i < radios.length; i++) {
            var radio = radios[i];
            radio.addEventListener('change', function (event) {
              if (event.target.id !== currentFruitId) {
                document.getElementById('fruit-love').innerHTML = `I love ${event.target.value}!`;
                document.getElementById(currentFruitId).checked = false;
                currentFruitId = event.target.id;
              }
            })
          }
          var currentColors = ['Green', 'Blue'];
          const checkboxes = document.querySelectorAll('.checkbox-color')
          for (var i = 0; i < checkboxes.length; i++) {
            var checkbox = checkboxes[i];
            checkbox.addEventListener('change', function (event) {
              if (!currentColors.includes(event.target.value)) {
                currentColors.push(event.target.value);
              } else {
                var index = currentColors.indexOf(event.target.value);
                currentColors.splice(index, 1);
              }
              document.getElementById('checkboxes-header').innerHTML = currentColors;
            })
          }
          document.getElementById('range-slider').addEventListener('input', function (event) {
            document.getElementById('volume-value').innerHTML = `&nbsp;${event.target.value}`;
            if (event.target.value > 80) {
              document.getElementById('careful-message').style.display = 'inline-block';
            } else {
              document.getElementById('careful-message').style.display = 'none';
            }
          })
        }
      </script>
  
      <style>
        .right-icon {
          margin-left: 10px;
        }
  
        .right-label {
          color: #666;
        }
      </style>
    </ons-page>
  </template>
  
  <template id="animations.html">
    <ons-page>
      <ons-list>
        <ons-list-header>Transitions</ons-list-header>
        <ons-list-item modifier="chevron" onclick="fn.pushPage({'id': 'transition.html', 'title': 'none'}, 'none')">
          none
        </ons-list-item>
   
      </ons-list>
    </ons-page>
  </template>
  
  <template id="pullHook.html">
    <ons-page>
      <ons-toolbar>
        <div class="left">
          <ons-back-button>Home1</ons-back-button>
        </div>
        <div class="center"></div>
      </ons-toolbar>
  
      <ons-pull-hook id="pull-hook" threshold-height="120px">
        <ons-icon id="pull-hook-icon" size="22px" class="pull-hook-content" icon="fa-arrow-down"></ons-icon>
      </ons-pull-hook>
  
      <ons-list id="kitten-list">
        <ons-list-header>Pull to refresh</ons-list-header>
      </ons-list>
  
      <script>
        ons.getScriptPage().onInit = function () {
          this.querySelector('ons-toolbar div.center').textContent = this.data.title;
          var pullHook = document.getElementById('pull-hook');
          var icon = document.getElementById('pull-hook-icon');
          pullHook.addEventListener('changestate', function (event) {
            switch (event.state) {
              case 'initial':
                icon.setAttribute('icon', 'fa-arrow-down');
                icon.removeAttribute('rotate');
                icon.removeAttribute('spin');
                break;
              case 'preaction':
                icon.setAttribute('icon', 'fa-arrow-down');
                icon.setAttribute('rotate', '180');
                icon.removeAttribute('spin');
                break;
              case 'action':
                icon.setAttribute('icon', 'fa-spinner');
                icon.removeAttribute('rotate');
                icon.setAttribute('spin', true);
                break;
            }
          });
          var getRandomName = function () {
            const names = ['Oscar', 'Max', 'Tiger', 'Sam', 'Misty', 'Simba', 'Coco', 'Chloe', 'Lucy', 'Missy'];
            return names[Math.floor(Math.random() * names.length)];
          };
          var getRandomUrl = function () {
            const width = 40 + Math.floor(20 * Math.random());
            const height = 40 + Math.floor(20 * Math.random());
            return `https://placekitten.com/g/${width}/${height}`;
          };
          var getRandomKitten = function () {
            return {
              name: getRandomName(),
              url: getRandomUrl()
            };
          };
          var getRandomData = function () {
            const data = [];
            for (var i = 0; i < 8; i++) {
              data.push(getRandomKitten());
            }
            return data;
          };
          var createKitten = function (kitten) {
            return ons.createElement(`
                <ons-list-item>
                  <div class="left">
                    <img class="list-item__thumbnail" src="${kitten.url}">
                  </div>
                  <div class="center">${kitten.name}</div>
                </ons-list-item>
              `
            );
          };
          var kittens = getRandomData();
          for (kitty of kittens) {
            var kitten = createKitten(kitty);
            document.getElementById('kitten-list').appendChild(kitten);
          };
          pullHook.onAction = function (done) {
            setTimeout(function() {
              document.getElementById('kitten-list').appendChild(createKitten(getRandomKitten()));
              done();
            }, 400);
          }
        };
      </script>
  
      <style>
        .pull-hook-content {
          color: #666;
          transition: transform .25s ease-in-out;
        }
      </style>
    </ons-page>
  </template>
  
  <template id="dialogs.html">
    <ons-page id="dialogs-page">
      <ons-toolbar>
        <div class="left">
          <ons-back-button>Home2</ons-back-button>
        </div>
        <div class="center"></div>
        <div class="right">
          <ons-toolbar-button id="info-button" onclick="fn.showDialog('popover-dialog')"></ons-toolbar-button>
        </div>
      </ons-toolbar>
  
      <ons-list-title>Notifications</ons-list-title>
      <ons-list modifier="inset">
        <ons-list-item tappable modifier="longdivider" onclick="ons.notification.alert('Hello, world!')">
          <div class="center">
            Alert
          </div>
        </ons-list-item>
        <ons-list-item tappable modifier="longdivider" onclick="ons.notification.confirm('Are you ready?')">
          <div class="center">
            Simple Confirmation
          </div>
        </ons-list-item>
        <ons-list-item tappable modifier="longdivider" onclick="ons.notification.prompt('What is your name?')">
          <div class="center">
            Prompt
          </div>
        </ons-list-item>
        <ons-list-item tappable modifier="longdivider" onclick="ons.notification.toast('Hi there!', { buttonLabel: 'Dismiss', timeout: 1500 })">
          <div class="center">
            Toast
          </div>
        </ons-list-item>
        <ons-list-item tappable modifier="longdivider" onclick="ons.openActionSheet({ buttons: ['Label 1', 'Label 2', 'Label 3', 'Cancel'], destructive: 2, cancelable: true })">
          <div class="center">
            Action/Bottom Sheet
          </div>
        </ons-list-item>
      </ons-list>
  
      <ons-list-title>Components</ons-list-title>
      <ons-list modifier="inset">
        <ons-list-item tappable modifier="longdivider" onclick="fn.showDialog('lorem-dialog')">
          <div class="center">
            Simple Dialog
          </div>
        </ons-list-item>
        <ons-list-item tappable modifier="longdivider" onclick="fn.showDialog('watHmmSure-dialog')">
          <div class="center">
            Alert Dialog
          </div>
        </ons-list-item>
        <ons-list-item tappable modifier="longdivider" onclick="fn.showDialog('toast-dialog')">
          <div class="center">
            Toast (top)
          </div>
        </ons-list-item>
        <ons-list-item tappable modifier="longdivider" onclick="fn.showDialog('modal-dialog')">
          <div class="center">
            Modal
          </div>
        </ons-list-item>
        <ons-list-item tappable modifier="longdivider" onclick="fn.showDialog('popover-dialog')">
          <div class="center">
            Popover - MD Menu
          </div>
        </ons-list-item>
        <ons-list-item tappable modifier="longdivider" onclick="fn.showDialog('action-sheet-dialog')">
          <div class="center">
            Action/Bottom Sheet
          </div>
        </ons-list-item>
      </ons-list>
  
      <!-- Components -->
      <ons-dialog id="lorem-dialog" cancelable>
        <!-- Optional page. This could contain a Navigator as well. -->
        <ons-page>
          <ons-toolbar>
            <div class="center">Simple Dialog</div>
          </ons-toolbar>
          <p style="text-align: center">Lorem ipsum dolor</p>
          <p style="text-align: center">
            <ons-button modifier="light" onclick="fn.hideDialog('lorem-dialog')">Close</ons-button>
          </p>
        </ons-page>
      </ons-dialog>
  
      <ons-alert-dialog id="watHmmSure-dialog" cancelable>
        <div class="alert-dialog-title">Hey!!</div>
        <div class="alert-dialog-content">
          Lorem ipsum
          <ons-icon icon="fa-commenting-o"></ons-icon>
        </div>
        <div class="alert-dialog-footer">
          <button class="alert-dialog-button" onclick="fn.hideDialog('watHmmSure-dialog')">Wat</button>
          <button class="alert-dialog-button" onclick="fn.hideDialog('watHmmSure-dialog')">Hmm</button>
          <button class="alert-dialog-button" onclick="fn.hideDialog('watHmmSure-dialog')">Sure</button>
        </div>
      </ons-alert-dialog>
  
      <ons-toast id="toast-dialog" animation="fall">Supercalifragilisticexpialidocious<button onclick="fn.hideDialog('toast-dialog')">No way</button></ons-toast>
  
      <ons-modal id="modal-dialog" onclick="fn.hideDialog('modal-dialog')">
        <p style="text-align: center">
          Loading
          <ons-icon icon="fa-spinner" spin></ons-icon>
          <br><br> Click or wait
        </p>
      </ons-modal>
  
      <ons-popover id="popover-dialog" cancelable direction="down" cover-target target="#info-button">
        <ons-list id="popover-list">
          <ons-list-item class="more-options" tappable onclick="fn.hideDialog('popover-dialog')">
            <div class="center">Call history</div>
          </ons-list-item>
          <ons-list-item class="more-options" tappable onclick="fn.hideDialog('popover-dialog')">
            <div class="center">Import/export</div>
          </ons-list-item>
          <ons-list-item class="more-options" tappable onclick="fn.hideDialog('popover-dialog')">
            <div class="center">New contact</div>
          </ons-list-item>
          <ons-list-item class="more-options" tappable onclick="fn.hideDialog('popover-dialog')">
            <div class="center">Settings</div>
          </ons-list-item>
        </ons-list>
      </ons-popover>
  
      <ons-action-sheet id="action-sheet-dialog" cancelable>
        <ons-action-sheet-button onclick="fn.hideDialog('action-sheet-dialog')" icon="md-square-o">Action 1</ons-action-sheet-button>
        <ons-action-sheet-button onclick="fn.hideDialog('action-sheet-dialog')" icon="md-square-o">Action 2</ons-action-sheet-button>
        <ons-action-sheet-button onclick="fn.hideDialog('action-sheet-dialog')" modifier="destructive" icon="md-square-o">Action 3</ons-action-sheet-button>
        <ons-action-sheet-button onclick="fn.hideDialog('action-sheet-dialog')" icon="md-square-o">Cancel</ons-action-sheet-button>
      </ons-action-sheet>
  
      <script>
        ons.getScriptPage().onInit = function () {
          this.querySelector('ons-toolbar div.center').textContent = this.data.title;
          var toolbarButton = ons.platform.isAndroid() ? ons.createElement(`<ons-icon icon="md-more-vert"></ons-icon>`) : ons.createElement(`<span>More</span>`);
          var infoButton = document.getElementById('info-button');
          infoButton.appendChild(toolbarButton);
          var toastDialog = document.getElementById('toast-dialog');
          toastDialog.parentNode.removeChild(toastDialog);
          document.getElementById('dialogs-page').appendChild(toastDialog);
          var timeoutID = 0;
          window.fn.showDialog = function (id) {
            var elem = document.getElementById(id);
            if (id === 'popover-dialog') {
              elem.show(infoButton);
            } else {
              elem.show();
              if (id === 'modal-dialog') {
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() { fn.hideDialog(id) }, 2000);
              }
            }
          };
          window.fn.hideDialog = function (id) {
            document.getElementById(id).hide();
          };
          const moreOptions = document.querySelectorAll('.more-options');
          if (!ons.platform.isAndroid()) {
            document.getElementById('watHmmSure-dialog').setAttribute('modifier', 'rowfooter');
            for (option of moreOptions) {
              option.hasAttribute('modifier') ?
                option.setAttribute('modifier', option.getAttribute('modifier') + ' longdivider') :
                option.setAttribute('modifier', 'longdivider');
            }
          } else {
            for (option of moreOptions) {
              option.hasAttribute('modifier') ?
                option.setAttribute('modifier', option.getAttribute('modifier') + ' nodivider') :
                option.setAttribute('modifier', 'nodivider');
            }
          }
        };
        document.getElementById('appNavigator').topPage.onDestroy = function () {
          var toastDialog = document.getElementById('toast-dialog');
          toastDialog.parentNode.removeChild(toastDialog);
          document.querySelector('#dialogs-page .page__content').appendChild(toastDialog);
        }
      </script>
  
      <style>
        #lorem-dialog .dialog-container {
          height: 200px;
        }
  
        ons-list-title {
          margin-top: 20px;
        }
      </style>
    </ons-page>
  </template>
  
  <template id="buttons.html">
    <ons-page>
      <ons-toolbar>
        <div class="left">
          <ons-back-button>Inicio</ons-back-button>
        </div>
        <div class="center"></div>
      </ons-toolbar>
  
      <section style="margin: 16px">
        <ons-button class="button-margin">Normal</ons-button>
        <ons-button modifier="quiet" class="button-margin">Quiet</ons-button>
        <ons-button modifier="outline" class="button-margin">Outline</ons-button>
        <ons-button modifier="cta" class="button-margin">Call to action</ons-button>
        <ons-button modifier="light" class="button-margin">Light</ons-button>
        <ons-button modifier="large" class="button-margin">Large</ons-button>
      </section>
  
      <section style="margin: 16px">
        <ons-button class="button-margin" disabled>Normal</ons-button>
        <ons-button modifier="quiet" class="button-margin" disabled>Quiet</ons-button>
        <ons-button modifier="outline" class="button-margin" disabled>Outline</ons-button>
        <ons-button modifier="cta" class="button-margin" disabled>Call to action</ons-button>
        <ons-button modifier="light" class="button-margin" disabled>Light</ons-button>
        <ons-button modifier="large" class="button-margin" disabled>Large</ons-button>
      </section>
  
      <ons-fab position="top right">
        <ons-icon icon="md-face"></ons-icon>
      </ons-fab>
  
      <ons-fab position="bottom left" disabled>
        <ons-icon icon="md-car"></ons-icon>
      </ons-fab>
  
      <ons-speed-dial position="bottom right" direction="up" :open.sync="spdOpen">
        <ons-fab>
          <ons-icon icon="md-share"></ons-icon>
        </ons-fab>
        <ons-speed-dial-item onclick="ons.notification.confirm(`Share on Twitter?`)">
          <ons-icon icon="md-twitter"></ons-icon>
        </ons-speed-dial-item>
        <ons-speed-dial-item onclick="ons.notification.confirm(`Share on Facebook?`)">
          <ons-icon icon="md-facebook"></ons-icon>
        </ons-speed-dial-item>
        <ons-speed-dial-item onclick="ons.notification.confirm(`Share on Google+`)">
          <ons-icon icon="md-google-plus"></ons-icon>
        </ons-speed-dial-item>
      </ons-speed-dial>
  
      <script>
        ons.getScriptPage().onInit = function () {
          this.querySelector('ons-toolbar div.center').textContent = this.data.title;
        }
      </script>
  
      <style>
        .button-margin {
          margin: 6px 0;
        }
      </style>
    </ons-page>
  </template>
  
  <template id="carousel.html">
    <ons-page>
      <ons-toolbar>
        <div class="left">
          <ons-back-button>Home5</ons-back-button>
        </div>
        <div class="center"></div>
      </ons-toolbar>
  
      <ons-carousel id="carousel" fullscreen swipeable auto-scroll overscrollable initial-index="0">
        <ons-carousel-item class="carousel-item" style="background-color: gray">
          <div class="color-tag">Gray</div>
        </ons-carousel-item>
        <ons-carousel-item class="carousel-item" style="background-color: #085078">
          <div class="color-tag">Blue</div>
        </ons-carousel-item>
        <ons-carousel-item class="carousel-item" style="background-color: #373B44">
          <div class="color-tag">Dark</div>
        </ons-carousel-item>
        <ons-carousel-item class="carousel-item" style="background-color: #D38312">
          <div class="color-tag">Orange</div>
        </ons-carousel-item>
      </ons-carousel>
  
      <div class="dots">
        <span id="dot0" class="dot" onclick="fn.swipe(this)">
          &#9679;
        </span>
        <span id="dot1" class="dot" onclick="fn.swipe(this)">
          &#9675;
        </span>
        <span id="dot2" class="dot" onclick="fn.swipe(this)">
          &#9675;
        </span>
        <span id="dot3" class="dot" onclick="fn.swipe(this)">
          &#9675;
        </span>
      </div>
  
      <script>
        ons.getScriptPage().onInit = function () {
          this.querySelector('ons-toolbar div.center').textContent = this.data.title;
          const carousel = document.getElementById('carousel');
          carousel.addEventListener('postchange', function () {
            var index = carousel.getActiveIndex();
            const dots = document.querySelectorAll('.dot');
            for (dot of dots) {
              dot.innerHTML = dot.id === 'dot' + index ? '&#9679;' : '&#9675;';
            }
          });
          window.fn.swipe = function (target) {
            carousel.setActiveIndex(Number(target.id.slice(-1)));
          }
        }
      </script>
  
      <style>
        .carousel-item {
          display: flex;
          justify-content: space-around;
          align-items: center;
        }
  
        .color-tag {
          color: #fff;
          font-size: 48px;
          font-weight: bold;
          text-transform: uppercase;
        }
  
        .dots {
          text-align: center;
          font-size: 30px;
          color: #fff;
          position: absolute;
          bottom: 40px;
          left: 0;
          right: 0;
        }
  
        .dots > span {
          cursor: pointer;
        }
      </style>
    </ons-page>
  </template>
  
  <template id="loadMore.html">
    <!-- Load more items on scroll bottom -->
    <ons-page id="load-more-page" on-infinite-scroll="fn.loadMore">
      <p class="intro">
        Useful for loading more items when the scroll reaches the bottom of the page, typically after an asynchronous API call.<br><br>
      </p>
  
      <ons-list id="list-node"></ons-list>
  
      <div class="after-list">
        <ons-icon icon="fa-spinner" size="26px" spin></ons-icon>
      </div>
  
      <script>
        ons.getScriptPage().onInit = function () {
          var listNode = document.getElementById('list-node');
          var createListItem = function (i) {
            return ons.createElement(`<ons-list-item>Item #${i}</ons-list-item>`);
          }
          for (var i = 0; i < 30; i++) {
            listNode.appendChild(createListItem(i));
          }
          window.fn.loadMore = function (done) {
            setTimeout(function() {
              const listLength = listNode.children.length;
              for (var i = 0; i < 10; i++) {
                listNode.appendChild(createListItem(listLength + i));
              }
              done();
            }, 600)
          }
        }
      </script>
  
      <style>
        .after-list {
          margin: 20px;
          text-align: center;
        }
      </style>
    </ons-page>
  </template>
  
  <template id="lazyRepeat.html">
    <!-- Lazy load thousands of items -->
    <ons-page id="lazy-repeat-page">
      <p class="intro">
        Automatically unloads items that are not visible and loads new ones. Useful when the list contains thousands of items.<br><br>
      </p>
  
      <ons-list>
        <ons-lazy-repeat id="infinite-list"></ons-lazy-repeat>
      </ons-list>
  
      <script>
        ons.getScriptPage().onInit = function () {
          var infiniteList = document.getElementById('infinite-list');
  
          infiniteList.delegate = {
            createItemContent: function (i) {
              return ons.createElement(`<ons-list-item>Item #${i}</ons-list-item>`);
            },
            countItems: function () {
              return 3000;
            }
          };
  
          infiniteList.refresh();
        }
      </script>
  
      <style>
        .intro {
          text-align: center;
          padding: 0 20px;
          margin-top: 40px;
        }
      </style>
    </ons-page>
  </template>
  
  <template id="infiniteScroll.html">
    <ons-page>
      <ons-toolbar>
        <div class="left">
          <ons-back-button>Home3</ons-back-button>
        </div>
        <div class="center"></div>
      </ons-toolbar>
  
      <ons-tabbar position="auto">
        <ons-tab label="Load More" page="loadMore.html"></ons-tab>
        <ons-tab label="Lazy Repeat" page="lazyRepeat.html" active></ons-tab>
      </ons-tabbar>
  
      <script>
        ons.getScriptPage().onInit = function () {
          this.querySelector('ons-toolbar div.center').textContent = this.data.title;
        }
      </script>
    </ons-page>
  </template>
  
  <template id="progress.html">
    <ons-page>
      <ons-toolbar>
        <div class="left">
          <ons-back-button>Home4</ons-back-button>
        </div>
        <div class="center"></div>
      </ons-toolbar>
  
      <ons-progress-bar id="progress-value" class="progressStyle" value="0"></ons-progress-bar>
  
      <section style="margin: 40px 16px">
        <p id="progress-status">
          Progress: 0%
        </p>
  
        <p>
          <ons-progress-bar class="progressStyle" value="20"></ons-progress-bar>
        </p>
  
        <p>
          <ons-progress-bar class="progressStyle" value="40" secondary-value="80"></ons-progress-bar>
        </p>
  
        <p>
          <ons-progress-bar class="progressStyle" indeterminate></ons-progress-bar>
        </p>
  
        <div style="text-align: center; margin: 40px; color: #666">
          <p>
            <ons-progress-circular class="progressStyle" value="20"></ons-progress-circular>
            <ons-progress-circular class="progressStyle" value="40" secondary-value="80"></ons-progress-circular>
            <ons-progress-circular class="progressStyle" indeterminate></ons-progress-circular>
          </p>
  
          <p>
            <ons-icon icon="ion-ios-cog" spin size="30px"></ons-icon>
            <ons-icon icon="ion-ios-cog" spin size="30px"></ons-icon>
            <ons-icon icon="ion-ios-cog" spin size="30px"></ons-icon>
            <ons-icon icon="ion-ios-cog" spin size="30px"></ons-icon>
          </p>
  
          <p>
            <ons-icon icon="fa-spinner" spin size="26px"></ons-icon>
            <ons-icon icon="circle-o-notch" spin size="26px"></ons-icon>
          </p>
  
          <p>
            <ons-icon icon="md-spinner" spin size="30px"></ons-icon>
          </p>
        </div>
  
        <p>
          <ons-button modifier="large">
            <ons-icon icon="ion-ios-cog" spin size="26px"></ons-icon>
          </ons-button>
          <br><br>
          <ons-button modifier="large" disabled>
            <ons-icon icon="ion-ios-cog" spin size="26px"></ons-icon>
          </ons-button>
        </p>
      </section>
  
      <script>
        ons.getScriptPage().onInit = function () {
          this.querySelector('ons-toolbar div.center').textContent = this.data.title;
          if (!ons.platform.isAndroid()) {
            const progressStyle = document.querySelectorAll('.progressStyle');
            for (progress of progressStyle) {
              progress.hasAttribute('modifier') ?
                progress.setAttribute('modifier', progress.getAttribute('modifier') + ' ios') :
                progress.setAttribute('modifier', 'ios');
            }
          }
          var progressStatus = document.getElementById('progress-status');
          var progressValue = document.getElementById('progress-value');
          var intervalID = 0;
          intervalID = setInterval(function() {
            if (progressValue.value === 100) {
              clearInterval(intervalID);
              return;
            }
            progressValue.value++;
            progressStatus.innerHTML = `Progress: ${progressValue.value}%`;
          }, 40);
        }
      </script>
  
      <style>
        /* 'ios' modifier */
  
        .progress-bar--ios__primary,
        .progress-bar--ios.progress-bar--indeterminate::before,
        .progress-bar--ios.progress-bar--indeterminate::after {
          background-color: #4282cc
        }
  
        .progress-bar--ios__secondary {
          background-color: #87b6eb;
        }
  
        .progress-circular--ios__primary {
          stroke: #4282cc
        }
  
        .progress-circular--ios__secondary {
          stroke: #87b6eb;
        }
      </style>
    </ons-page>
  </template>
  
  <template id="transition.html">
    <ons-page>
      <ons-toolbar>
        <div class="left">
          <ons-back-button>Animations</ons-back-button>
        </div>
        <div class="center"></div>
      </ons-toolbar>
      <p style="text-align: center">
        Use the VOnsBackButton
      </p>
      <script>
        ons.getScriptPage().onInit = function () {
          this.querySelector('ons-toolbar div.center').textContent = this.data.title;
        }
      </script>
    </ons-page>
  </template>
  

  {{-- pagina negocio --}}
  <template id="negocio.html">
    <ons-page>
      <ons-toolbar>
        <div class="left">
          <ons-back-button>Atras</ons-back-button>
        </div>
        <div class="center"></div>
      </ons-toolbar>
 
      <script>
          ons.getScriptPage().onInit = function () {
            this.querySelector('ons-toolbar div.center').textContent = this.data.title;
          }
      </script>
    </ons-page>
  </template>

   <style>
    ons-splitter-side[animation=overlay] {
      border-left: 1px solid #bbb;
    }
  </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.0/axios.min.js"></script>
  <script>
    window.fn = {};
    window.fn.toggleMenu = function () {
      document.getElementById('appSplitter').right.toggle();
    };
    
    window.fn.loadView = function (index) {
      document.getElementById('appTabbar').setActiveTab(index);
      document.getElementById('sidemenu').close();
    };

    window.fn.loadLink = function (url) {
      window.open(url, '_blank');
    };

    window.fn.pushPage = function (page, anim) {
      if (anim) {
        document.getElementById('appNavigator').pushPage(page.id, { data: { title: page.title }, animation: anim });
      } else {
        document.getElementById('appNavigator').pushPage(page.id, { data: { title: page.title } });
      }
    };

    $(document).ready(function () {
      // minegocios()
    });
    async function minegocios() {
      const config = { headers: { 'Content-Type': 'multipart/form-data', 'Accept': 'application/json', 'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjExNjc1NTNjNWRlMDZmYTkyOGE1MjYyOGZjNjgxYzRlYTM0MzY5YmE2OTBlYTQ2NmMyYzY1YjE5ZGNiYjI4NTUwZjM1YjhkZmIxNWY0YTkzIn0.eyJhdWQiOiIxIiwianRpIjoiMTE2NzU1M2M1ZGUwNmZhOTI4YTUyNjI4ZmM2ODFjNGVhMzQzNjliYTY5MGVhNDY2YzJjNjViMTlkY2JiMjg1NTBmMzViOGRmYjE1ZjRhOTMiLCJpYXQiOjE2NzQ5NDMwNzUsIm5iZiI6MTY3NDk0MzA3NSwiZXhwIjoxNzA2NDc5MDc1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.ZtO5ruv_P0HuvECUsvKR3gOSVKNUBK87SqQ_K28wzKzKlyVFKYMDZxm8l_I4tYJsVBTik9WnTtNeamJ_Moqr2naEFWMinaCUAamJbfFgSvViGJHCZiwtkkwFput5d3IPDimDt0oFRR4T0rI4r0TLjLnE5SMixCW8AiaoNsXHB5HCfHU9zJM7T1p_gA78ePEGQWt_PPpjobbNFvOoQ5R4by7_T4-QkqkgvIIdD9OL5lNXeTg-DzZDOb1yXclOyt-8EA0Ag4ANcpBIFpqSJ8ETpLbwnQFrQeN8FSKjwyo1cOnqUtMF46aq0Um3etd_mctLhSb-yqtMh6z5_HMD8ccouUHJH2NeMf9uT_tbzipzs0IM1JVXkGttRA82Dxangvb8yNGpNXSFOmwXok6pAv_8liI0l2KiXyHTs8ZHsCsgMALZnTketnMV7HdW_aqTrG4ziLEq7DmBf6xXUq3EztyoGqdDqCBcqlW40l001NmYCsrrPVzzUg5ddOAWPhspGgX25XoXhsReHBGbn1qmhwUPKiFbnDoNoReEdxA-MMdE-X_0V7MnksNKNtYpxYO0PS9WS4umGNkaUvCu7-GqRd22X29K_MVXEnPuH8iTADQTsjPujpvcKpajYVHJJAeYP-f7KEdmPD1kkKMyIYVQclRZtw-RjrmRqK5j3T_d8FxXJCU'} };
      var negocios = await axios.get("/connector/api/active-subscription", config)
      console.log(negocios.data.length)
    }
  </script>
</body>
</html>