<template>
    <div class="bulveyz-select" :class="{'bulveyz-selected-show': show}">
        <select v-show="false" :name="name">
            <option :value="value"></option>
        </select>
        <div class="bulveyz-select-header" @click="show = !show" :class="{'bulveyz-select-header-selected': label}">
            <i v-if="icon" :class="['bulveyz-select-icon', icon]"></i>
            <span v-if="!label">{{placeholder}}</span>
            <span v-else>{{label}}</span>
            <i v-if="show" :class="['bulveyz-select-toggle-icon', iconOnShow]"></i>
            <i v-if="!show" :class="['bulveyz-select-toggle-icon', iconOnHide]"></i>
        </div>
        <transition name="slide">
            <div class="bulveyz-select-list vb" style="height: 180px" v-bar="{preventParentScroll: true}" v-show="show">
                <ul>
                    <li :class="['bulveyz-select-list-item', {'active': option.active}]" @click="selected(option, index)"
                        v-for="(option, index) in options" :key="index">{{option.label}}
                    </li>
                </ul>
            </div>
        </transition>
        <slot></slot>
        <div @click="show = !show" class="overlay" v-if="show"></div>
    </div>
</template>

<script>
  import Vuebar from './Vuebar/vuebar';
  export default {
    props: {
      placeholder: String,
      required: false,
      active: {
        default: false
      },
      name: String,
      icon: {
        default: false
      },
      iconOnShow: {
        default: 'fa fa-angle-up'
      },
      iconOnHide: {
        default: 'fa fa-angle-down'
      },
    },
    components: {
      Vuebar
    },
    data() {
      return {
        options: [],
        show: false,
        label: false,
        value: null,
        scrollOptions: {
          width: '300px',
          height: '100px',
          color: '#ffcc00',
          alwaysVisible: true,
        }
      }
    },
    methods: {
      optionsCollect() {
        this.options = this.$children;
      },
      selected(option, index) {
        this.setActiveOption(option);
      },
      checkTarget(selectedOption) {
        if (this.required) {
          return true;
        } else if (selectedOption.active) {
          selectedOption.active = false;
          this.value = null;
          this.label = false;
          return false;
        } else {
          return true;
        }
      },
      setActiveOption(selectedOption) {
        if (this.checkTarget(selectedOption)) {
          this.options.forEach(option => {
            if (selectedOption.label == option.label) {
              option.active = true;
              this.value = option.value;
              this.label = option.label;
            } else {
              option.active = false;
            }
          });
        }
      },
      setActiveOptionOnDefault() {
        if (this.active) {
          this.options.forEach(option => {
            if (this.active == option.value) {
              option.active = true;
              this.value = option.value;
              this.label = option.label
            } else {
              option.active = false;
            }
          });
        }
      }
    },
    watch: {
      value() {
        this.$emit('input', this.value);
      }
    },
    created() {
      this.optionsCollect();
    },
    mounted() {
      this.setActiveOptionOnDefault();
    }
  }
</script>

<style>
    .bulveyz-select {
        position: relative;
        background-color: #fff;
    }

    .bulveyz-select-header {
        position: relative;
        padding: .5rem .8rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #8c98a4;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e6e7e9;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .bulveyz-selected-show .bulveyz-select-header {
        z-index: 1000;
    }

    .bulveyz-select-list {
        position: absolute !important;
        top: 55px;
        height: 180px;
        width: 100%;
        margin: 0;
        border-radius: .25rem;
        border: 1px solid #e6e7e9;
        background-color: #fff;
        box-shadow: 0 2px 20px 0 rgba(153, 155, 168, 0.12);
        z-index: 1001;
        padding-top: 0;
    }

    .bulveyz-select-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .bulveyz-select-list-item {
        padding: .79rem;
        transition: .2s;
        margin-right: 25px !important;
        padding-left: 25px !important;
        box-sizing: border-box;
    }

    .bulveyz-select-list-item:hover {
        background-color: rgba(243, 243, 243, 0.17);
        border-bottom-right-radius: 25px;
        border-top-right-radius: 25px;
        color: rgba(48, 121, 244, .5);
        cursor: pointer;
    }

    .bulveyz-select-list-item.active {
        color: rgba(48, 121, 244, .5);
    }

    .bulveyz-select-icon {
        margin-right: 10px;
        color: #8c98a4 !important;
    }

    .bulveyz-select-toggle-icon {
        margin-top: 5px;
        float: right;
        margin-right: 10px;
    }

    .bulveyz-select-header-selected {
        color: #1b1e24 !important;
    }

    .bulveyz-select:hover {
        cursor: pointer;
    }

    .bulveyz-select-list:after {
        content: '';
        position: absolute;
        right: 5px;
        top: 5px;
        border-radius: 20px;
        width: 7px;
        height: 170px;
        background: #f3f3f3;
    }

    .slide-enter-active, .slide-leave-active {
        transition: .4s;
    }
    .slide-enter, .slide-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
    }


    .slide-enter {
        transform: translateY(10px);
    }

    .slide-leave-to {
        transform: translateY(10px);
    }

    .overlay {
        position: fixed;
        left: 0;
        top: 0;
        z-index: 999;
        background: transparent;
        width: 100%;
        height: 100%;
    }

    .overlay:hover {
        cursor: default;
    }

    .vb > .vb-dragger {
        z-index: 5;
        width: 12px;
        right: 0;
    }

    .vb > .vb-dragger > .vb-dragger-styler {
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: rotate3d(0,0,0,0);
        transform: rotate3d(0,0,0,0);
        -webkit-transition:
                background-color 100ms ease-out,
                margin 100ms ease-out,
                height 100ms ease-out;
        transition:
                background-color 100ms ease-out,
                margin 100ms ease-out,
                height 100ms ease-out;
        background-color: rgba(48, 121, 244,.5);
        margin: 5px 5px 5px 0;
        border-radius: 20px;
        height: calc(100% - 10px);
        display: block;
    }

    .vb.vb-scrolling-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(48, 121, 244,.5);
    }

    .vb > .vb-dragger:hover > .vb-dragger-styler {
        background-color: rgba(48, 121, 244,.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(48, 121, 244,.5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(48, 121, 244,.5);
    }
</style>