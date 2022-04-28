var app = new Vue({
    el: '#page',

    data: {
        sites: [],
        selected_site_id: '',
        selected_site: null,
        selected_server: null,
        group_patches: [],
    },

    watch: {
        selected_site_id: function(newVal) {
            this.selected_site = this.sites.find(i => i.id == newVal)
            this.getGroupPatchStatus()
        },
        selected_server: function(newVal) {
            $("#selected_server_id").val(newVal.id)
            $("#button_selected_server").trigger('click')
        }
    },

    mounted() {
        this.init()
    },

    methods:{
        init() {
            axios.get('/get_sites').then(response => {
                this.sites = response.data
                this.selected_site_id = this.sites[0].id
                this.selected_server = this.sites[0].apps[0].servers[0]
            })
        },
        getGroupPatchStatus() {
            axios.post('/get_group_patch_status', {site_id: this.selected_site_id}).then(response => {
                this.group_patches = response.data
            })
        }
    },
});


