const Settings = {

    name: 'highlight-settings', // keep alive  
    el: '#highlight-settings', //view.php div-> id //v-cloak allload to show

    data() {
        return {
            stylelists: [],
            highlight: window.$data,
        };
    },
    mixins: [Theme.Mixins.Helper],
    theme: {
        hiddenHtmlElements: ['.pk-width-content li > div.uk-flex'],
        elements() {
            var vm = this;
            return {
                'submit': {
                    scope: 'topmenu-left',
                    type: 'button',
                    caption: 'Save',
                    class: 'uk-button uk-button-primary',
                    on: {
                        click: () => vm.save()
                    },
                    priority: 0,
                }
            }
        }
    },

    mounted() {
        this.load();
    },

    methods: {
        load() {
            this.$http.get('admin/highlight/config').then(function(response) {
                this.stylelists = response.data.styles;
            }).catch(function() {
                this.$notify('Could not load styles.');
            });
        },

        save() {
            this.$http.post('admin/system/settings/config', {
                name: 'highlight',
                config: this.highlight.config
            }).then(function() {
                this.$notify('Settings saved.', '');
            }).catch(function(response) {
                this.$notify(response.message, 'danger');
            }).finally(function() {
                // this.$parent.close();
            });
        }
    }

};
export default Settings;
Vue.ready(Settings);