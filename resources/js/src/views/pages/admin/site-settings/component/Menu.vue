<template>

             <div class="pr-20 pl-5 pb-10 mb-10 bg-grey">

                <vs-list>
                <vs-list-header :title="$t('draggableMenu')" color="primary"></vs-list-header>
                <draggable v-model='Menu' :Menu="Menu">
                    <transition-group>
                    <vx-card v-for="(mainMenu,mainMenuKey)  in Menu" :key="mainMenu.id" class="mb-5 ml-2 mr-5 sm:w-5/7" >
                    <div class="vx-row">
                          <div class="vx-col sm:w-1/12  mt-5">
                              <p class="text-lg font-semibold">
                                  {{$t('id')}}:{{mainMenu.id}}
                              </p>
                          </div>
                          <div class="vx-col sm:w-8/12 mb-2">
                            <vs-select v-model="mainMenu.data" :label="$t('Title')"  name="Title" class=" w-full">
                              <vs-select-item :key="page.id" :value="page.slug[locale]" :text="page.title[locale]" v-for="page in pages" />
                            </vs-select>
                          </div>

                          <div class="vx-col sm:w-1/12  mt-5">
                                <feather-icon @click="removeThis(mainMenuKey,'Menu')" icon="XCircleIcon" svgClasses="w-10 h-10 text-red"></feather-icon>
                          </div>
                          <div class="vx-col sm:w-1/12  mt-5">
                                <feather-icon @click="addMenu('Menu')" icon="PlusCircleIcon" svgClasses="w-10 h-10 text-red"></feather-icon>
                          </div>
                          <div class="vx-col sm:w-1/12  mt-5">
                                <feather-icon @click="addSubMenu('Menu','subMenu',mainMenuKey)" icon="MenuIcon" svgClasses="w-10 h-10 text-red"></feather-icon>
                          </div>
                        </div>

                            <!--- SUBMENU START --->
                            <vx-card

                                    v-for="(subMenu,submenuKey)  in mainMenu.subMenu"
                                    :key="subMenu.id"
                                    class="mb-3 ml-24 sm:w-4/5 bg-grey"  >

                            <div class="vx-row" >
                                 {{$t('subId')}}:{{subMenu.id}}
                                <div class="vx-col sm:w-10/12 mb-2">
                                            <vs-select v-model="subMenu.data" :label="$t('Title')"  name="Title" class=" w-full">
                                            <vs-select-item :key="page.id" :value="page.slug[locale]" :text="page.title[locale]" v-for="page in pages" />
                                            </vs-select>
                                </div>

                                <div class="vx-col sm:w-1/12  mt-5">
                                    <feather-icon
                                          @click="removeSubMenu('Menu',mainMenuKey,'subMenu',submenuKey)"
                                          icon="XCircleIcon"
                                          svgClasses="w-10 h-10 text-red">
                                     </feather-icon>
                                </div>
                            </div>
                            </vx-card>
                            <!--- SUBMENU END --->




                     </vx-card>
                   </transition-group>
                </draggable>
                </vs-list>


             <vs-button
                        v-show="Menu.length == 0"
                       class="ml-3 shadow-lg"
                       type="gradient" color="#10163A"
                       gradient-color-secondary="#E8603B"
                       @click="addMenu('Menu')">{{$t('addNew')}}
             </vs-button>


                <div class="flex flex-wrap items-center justify-end">
                      <vs-button
                       class="ml-3 shadow-lg"
                       type="gradient" color="#F93E0B"
                       gradient-color-secondary="#E8603B"
                       @click="SaveData('Menu')">{{$t('save')}}
            </vs-button>

                </div>
             </div>



</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import draggable from 'vuedraggable'



export default {
  components: {
    flatPickr,
    vSelect,
    draggable
  },

  data () {
    return {
      Menu:
      [
        {
          id: 1,
          data: '',
          subMenuData: false,
          subMenu:
               [
                {
                    id: 1,
                    data: '',

                }
             ],
        }
      ]
    }
  },
  methods:{
    addMenu (type) {
      return this[type].push({
          id: (parseInt(this[type].length))+(parseInt(1)),
          data: '',
          subMenuData: false,
          subMenu: [],
        })
    },

    addSubMenu (type,subType,index) {
     this[type][index][subType].push({ id: (parseInt(this[type][index][subType].length))+(parseInt(1)),data: ''})
        return this[type][index].subMenuData = true
    },

    removeSubMenu (mainType,mainIndex,subType,subTypeIndex) {
        console.log('clicked',this[mainType][mainIndex][subType])
        console.log('mainIndex',mainIndex)
        console.log('subTypeIndex',subTypeIndex)
      this[mainType][mainIndex][subType].splice(subTypeIndex, 1)
    },

    removeThis (index, type) {
      this[type].splice(index, 1)
    },


    SaveData (dataType) {
      const obj = {
        [dataType]: this[dataType],
        type: dataType
      }
      console.log(obj)
      this.$store.dispatch('custom/addItem', obj).then((response) => {
        this.$vs.notify({
          title: 'Başarılı',
          text:' İçerik Başarıyla Eklendi',
          iconPack: 'feather',
          icon: 'icon-success',
          color: 'success'
        })

      }).catch(error => {
        this.$vs.notify({
          title: 'Hata',
          text: 'İçerik Eklenemedi.',
          iconPack: 'feather',
          icon: 'icon-alert-circle',
          color: 'danger'
        })
      })
    },
      sliderUpload (input,index,type) {
        //console.log(input.target.files[0])
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
         return this[type][index].image = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    openFileInput (type) {
      return this.$refs[type][0].click()
    }

  },
  computed: {
    activeUserInfo () {
      return this.$store.state.auth.user
    },
    pages() {
      return this.$store.state.post.pages
    },
    locale() {
      return this.$i18n.locale
    },

  },
  watch : {
    Menu: function (value) {
                console.log(value)
                this.Menu = value
            },
     'Menu.subMenuData':{
            handler: function (after, before) {
                //console.log(after,before)
            },
            deep: true
        }
  },
  created () {
    this.$store.dispatch("post/fetchItems")
    this.$store.dispatch('custom/fetchItems')
      .then((response) => {

        response.data.forEach(element => {
          if (element.type === 'Menu') {
            this[element.type].push(JSON.parse(element.JsonData)[element.type])
            this[element.type].splice(0, 1)
            this[element.type] = this[element.type][0]

          } else {
            this[element.type] = JSON.parse(element.JsonData)[element.type]
          }

        })

      })
      .catch((error) => { console.log(error) })

  }
}
</script>
