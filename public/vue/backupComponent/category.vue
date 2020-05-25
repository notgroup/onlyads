<template>
    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Stexo</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>


            <div class="row">
                <div class="col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Friends Suggestions</h4>
                            <div class="friends-suggestions">
                                <a href="#" class="friends-suggestions-list">
                                    <div class="border-bottom position-relative">
                                        <div class="float-left mb-0 mr-3">
                                            <img src="assets/images/users/user-2.jpg" alt="" class="rounded-circle thumb-md">
                                        </div>
                                        <div class="suggestion-icon float-right mt-2 pt-1">
                                            <i class="mdi mdi-plus"></i>
                                        </div>

                                        <div class="desc">
                                            <h5 class="font-14 mb-1 pt-2 text-dark">Ralph Ramirez</h5>
                                            <p class="text-muted">3 Friend suggest</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="friends-suggestions-list">
                                    <div class="border-bottom position-relative">
                                        <div class="float-left mb-0 mr-3">
                                            <img src="assets/images/users/user-3.jpg" alt="" class="rounded-circle thumb-md">
                                        </div>
                                        <div class="suggestion-icon float-right mt-2 pt-1">
                                            <i class="mdi mdi-plus"></i>
                                        </div>

                                        <div class="desc">
                                            <h5 class="font-14 mb-1 pt-2 text-dark">Patrick Beeler</h5>
                                            <p class="text-muted">17 Friend suggest</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="friends-suggestions-list">
                                    <div class="border-bottom position-relative">
                                        <div class="float-left mb-0 mr-3">
                                            <img src="assets/images/users/user-4.jpg" alt="" class="rounded-circle thumb-md">
                                        </div>
                                        <div class="suggestion-icon float-right mt-2 pt-1">
                                            <i class="mdi mdi-plus"></i>
                                        </div>

                                        <div class="desc">
                                            <h5 class="font-14 mb-1 pt-2 text-dark">Victor Zamora</h5>
                                            <p class="text-muted">12 Friend suggest</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="friends-suggestions-list">
                                    <div class="border-bottom position-relative">
                                        <div class="float-left mb-0 mr-3">
                                            <img src="assets/images/users/user-5.jpg" alt="" class="rounded-circle thumb-md">
                                        </div>
                                        <div class="suggestion-icon float-right mt-2 pt-1">
                                            <i class="mdi mdi-plus"></i>
                                        </div>

                                        <div class="desc">
                                            <h5 class="font-14 mb-1 pt-2 text-dark">Bryan Lacy</h5>
                                            <p class="text-muted">18 Friend suggest</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="#" class="friends-suggestions-list">
                                    <div class="position-relative">
                                        <div class="float-left mb-0 mr-3">
                                            <img src="assets/images/users/user-6.jpg" alt="" class="rounded-circle thumb-md">
                                        </div>
                                        <div class="suggestion-icon float-right mt-2 pt-1">
                                            <i class="mdi mdi-plus"></i>
                                        </div>

                                        <div class="desc">
                                            <h5 class="font-14 mb-1 pt-2 text-dark">James Sorrells</h5>
                                            <p class="text-muted mb-1">6 Friend suggest</p>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="card m-b-30">
                        <div class="card-body">

                            <h4 class="mt-0 header-title mb-4">Recent Activity</h4>
                            <ol class="activity-feed mb-0">
                                <li class="feed-item">
                                    <div class="feed-item-list">
                                        <p class="text-muted mb-1">Now</p>
                                        <p class="font-15 mt-0 mb-0">Andrei Coman posted a new article: <b class="text-primary">Forget UX Rowland</b></p>
                                    </div>
                                </li>
                                <li class="feed-item">
                                    <p class="text-muted mb-1">Yesterday</p>
                                    <p class="font-15 mt-0 mb-0">Andrei Coman posted a new article: <b class="text-primary">Designer Alex</b></p>
                                </li>
                                <li class="feed-item">
                                    <p class="text-muted mb-1">2:30PM</p>
                                    <p class="font-15 mt-0 mb-0">Zack Wetass, <b class="text-primary"> Developer Moreno</b></p>
                                </li>
                                <li class="feed-item pb-1">
                                    <p class="text-muted mb-1">12:48 PM</p>
                                    <p class="font-15 mt-0 mb-2">Zack Wetass, <b class="text-primary">UX Murphy</b></p>
                                </li>

                            </ol>

                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Active Deals</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="1" scope="col">Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Date</th>
                                            <th scope="col" colspan="1">edit</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(item, key) in items">
                                        <tr>
                                            <td><img :src="'assets/images/users/user-2.jpg' || item.attributes.resimler[0]" alt="" class="thumb mr-2" width="48px" ></td>
                                            <td>
                                                <a :href="'#/compare/' + item.entity_id">{{item.title}}</a>
                                                
                                                </td>
                                            <td>$9,420,000</td>
                                            <td>
                                                contact
                                            </td>

                                            <td>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                            </template>
                                       
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
  </template>
  <script>
  module.exports = {
    name: "home",
    data() {
    return {
        items: []
    };
    },
    computed: {},
    mounted() {},
    beforeCreate() {},
    created() {
        this.get(apiUrl + '/last10', (res) => {
            console.log(res);
            
            this.items = res
			});
    },
    methods: {}
  }
  </script>
  <style>
  </style>

