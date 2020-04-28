var app = new Vue({
    el: '#app',
    data: {
      users: [],
      user: null,
      userCache: {},
      profileLoading: false,
      tableLoading: true
    },
    created: function() {
        this.getUsers();
    },
    methods: {
        getUsers: function() {
            var self = this;

            fetch('https://jsonplaceholder.typicode.com/users')
            .then(function(response){
                response.json().then(function(data){
                    self.users = data;
                }).finally(function(){
                    self.tableLoading = false;
                });
            });
        },
        getUserDetails: function(id) {
            var self = this;

            if (self.userCache.hasOwnProperty(id)) {
                self.user = self.userCache[id];
                self.profileLoading = false;
            } else {
                self.profileLoading = true;

                fetch('https://jsonplaceholder.typicode.com/users/' + id)
                .then(function(response){
                    response.json().then(function(data){
                        self.userCache[id] = data;
                        self.user = data;
                    });
                }).catch(function(){
                    self.user = null;
                }).finally(function(){
                    self.profileLoading = false;
                });
            }
        },
        sortTable: function(col) {
            this.users.sort(function(a, b) {
                if (a[col] > b[col]) {
                    return 1;
                } else if (a[col] < b[col]) {
                    return  -1;
                }

                return 0;
            });
        }
    }
  });