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
                        <li class="breadcrumb-item" @click="example = 1">cimri</li>
                        <li class="breadcrumb-item" @click="example = 2">epey</li>
                        <li class="breadcrumb-item active" @click="example = 0">Single</li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <div class="row" v-if="example == 1">
            <img src="tmp/cimri.png" alt="" style="
    width: 100%;
">
        </div>
        <div class="row" v-if="example == 2">
            <img src="tmp/epey.png" alt="" style="
    width: 100%;
">
        </div>

        <div class="row" v-if="!example">

            <div class="col-xl-3">

                <div class="card m-b-30">
                    <div class="card-body text-center" style="
    padding: 10px;
    border-bottom: 1px solid #f0f4f7;
">
                        <img v-if="item && item.attributes" v-for="img in item.attributes.resimler" :src="img" height="48px" width="48px">
                    </div>
                    <div class="card-body text-center">
                        <img v-if="item && item.attributes" :src="item.attributes.resimler[0]" alt="" style="
    max-width: 80%;
">
                        <div class="s98wa6g-2 lgepKz">
                            <div class="s10m9o5g-36 cbqvoK"><i class="fa fa-plus"></i> <span> Karşılaştırmaya ekle</span></div>
                        </div>
                    </div>
                </div>
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
                <div class="card faq-box border-success">
                    <div class="card-body">
                        <div class="faq-icon float-right">
                            <i class="fas fa-question-circle font-24 mt-2 text-success"></i>
                        </div>
                        <h5 class="text-success">01.</h5>
                        <h5 class="font-16 mb-3 mt-4">What is Lorem Ipsum?</h5>
                        <p class="text-muted mb-0">Phasellus eros odio Curabitur hendrerit neque at vestibulum consequat Cras nibh ipsum tempor ac ex eget eu elit eget cursus Fusce eu consequat nisl Praesent vel dictum enim ac convallis dolor Proin in velit vel enim laoreet cursus.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card faq-box border-success">
                    <div class="card-body">
                        <div class="faq-icon float-right"><i class="fas fa-question-circle font-24 mt-2 text-success"></i></div>
                        <h5 class="text-success">{{item.title}}</h5>
                        <p class="text-muted mb-0">
                                        <img src="tmp/fiyaten.png" alt="" style="
    width: 100%;
"> 750 piksel çözünürlüğe sahip 4.7 inç dokunmatik ekrana sahiptir. Gömülü M10 hareket işlemcisi ile Apple A10 Fusion çip Arka tarafta 12 MP ve ön tarafta portereler için 7 MP kameralar ile mükemmel fotoğraflar çekebilirsiniz. 32GB dahili depolama (iCloud ile genişletilebilir) alanı ile daha fazla saklama alanının keyfini çıkarabilirsiniz. Yenilenmiş kasası ile su dökülmelerine ve sıçramalarına hatta toza karşı bile dayanıklılığı ile güvenle kullanma imkanı sunar.</p>

                    </div>
                    <div class="card-footer bg-white">
                        <div class="inline" style="float: left;">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> <strong> 15 Yorum</strong>
                        </div>

                        <div class="btn-toolbar float-lg-right" role="toolbar">
                            <div class="btn-group mo-mb-2">
                                <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                                <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
                            </div>
                            <div class="btn-group ml-1 mo-mb-2">
                                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-folder"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Updates</a>
                                    <a class="dropdown-item" href="#">Social</a>
                                    <a class="dropdown-item" href="#">Team Manage</a>
                                </div>
                            </div>
                            <div class="btn-group ml-1 mo-mb-2">
                                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-tag"></i>
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                    <a class="dropdown-item" href="#">Updates</a>
                                    <a class="dropdown-item" href="#">Social</a>
                                    <a class="dropdown-item" href="#">Team Manage</a>
                                </div>
                            </div>

                            <div class="btn-group ml-1 mo-mb-2">
                                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    More
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Mark as Unread</a>
                                    <a class="dropdown-item" href="#">Mark as Important</a>
                                    <a class="dropdown-item" href="#">Add to Tasks</a>
                                    <a class="dropdown-item" href="#">Add Star</a>
                                    <a class="dropdown-item" href="#">Mute</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive m-b-20  bg-white">
                    <table class="table table-bordered table-striped table-xs m-b-0">
                        <thead class="bg-white">
                            <tr>
                                <th scope="col" colspan="3">FİYATLAR</th>

                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(price, key) in prices">
                                <tr :key="key">
                                    <td><img :src="price.storeLogo" alt=""> </td>
                                    <td>{{price.title}}</td>
                                    <td>{{price.price}}</td>
                                </tr>
                            </template>

                        </tbody>
                    </table>
                </div>

                <div class="card m-b-30 hide">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Justify Tabs</h4>
                        <p class="sub-title">Use the tab JavaScript plugin—include
                            it individually or through the compiled <code class="highlighter-rouge">bootstrap.js</code>
                            file—to extend our navigational tabs and pills to create tabbable panes
                            of local content, even via dropdown menus.</p>

                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">
                                    <span class="d-none d-md-block">Home</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">
                                    <span class="d-none d-md-block">Profile</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab">
                                    <span class="d-none d-md-block">Messages</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#settings-1" role="tab">
                                    <span class="d-none d-md-block">Settings</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="home-1" role="tabpanel" style="
    padding-right: 0!important;
    padding-left: 0!important;
">
                                <div class="table-responsive1">
                                    <table class="table table-bordered table-striped table-xs">
                                        <thead class="bg-white">
                                            <tr>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-for="(price, key) in prices">
                                                <tr :key="key">
                                                    <td><img :src="price.storeLogo" alt=""> </td>
                                                    <td>{{price.title}}</td>
                                                    <td>{{price.price}}</td>
                                                </tr>
                                            </template>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                <p class="mb-0">
                                    Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                    single-origin coffee squid. Exercitation +1 labore velit, blog
                                    sartorial PBR leggings next level wes anderson artisan four loko
                                    farm-to-table craft beer twee. Qui photo booth letterpress,
                                    commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                                    vinyl cillum PBR. Homo nostrud organic, assumenda labore
                                    aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr,
                                    vero magna velit sapiente labore stumptown. Vegan fanny pack
                                    odio cillum wes anderson 8-bit.
                                </p>
                            </div>
                            <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                                <p class="mb-0">
                                    Etsy mixtape wayfarers, ethical wes anderson tofu before they
                                    sold out mcsweeney's organic lomo retro fanny pack lo-fi
                                    farm-to-table readymade. Messenger bag gentrify pitchfork
                                    tattooed craft beer, iphone skateboard locavore carles etsy
                                    salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                                    Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                                    mi whatever gluten-free, carles pitchfork biodiesel fixie etsy
                                    retro mlkshk vice blog. Scenester cred you probably haven't
                                    heard of them, vinyl craft beer blog stumptown. Pitchfork
                                    sustainable tofu synth chambray yr.
                                </p>
                            </div>
                            <div class="tab-pane p-3" id="settings-1" role="tabpanel">
                                <p class="mb-0">
                                    Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                                    art party before they sold out master cleanse gluten-free squid
                                    scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                                    art party locavore wolf cliche high life echo park Austin. Cred
                                    vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                                    farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral,
                                    mustache readymade thundercats keffiyeh craft beer marfa
                                    ethical. Wolf salvia freegan, sartorial keffiyeh echo park
                                    vegan.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card card-body m-b-30" style="display: block; font-size: 15px; font-weight: 600; border-bottom: 1px solid rgb(255, 87, 34);"><img src="tmp/gecmis2.png" alt="" style="
    width: 100%;
"></div>
<div class="card card-body m-b-30" style="
    display: block;
    font-size: 15px;
    font-weight: 600;
    border-bottom: 1px solid #ff5722;">ÖZELLİKLER</div>

                <div class="row">
                    <div class="col-md-6 ">


                    <div v-if="item && item.attributes &&  item.attributes.content" v-for="(itemo, index) in item.attributes.content" class="symbol-target" :id="index.toLowerCase().replace(' ', '')">

                        <div class="table-responsive m-b-20  bg-white">
                            <table class="table table-bordered table-striped table-xs m-b-0">
                                <thead class="bg-white">
                                    <tr>
                                        <th scope="col" colspan="2">{{index}} <i class="fa fa-cog text-right" style="
    float: right;
    vertical-align: middle;
    font-size: 16px;
"></i></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(meta, key) in itemo">
                                        <tr :key="key">
                                            <td>{{meta.key}}</td>
                                            <td v-html="Array.isArray(meta.value) ? meta.value.join('<br>') : meta.value"> {{Array.isArray(meta.value) ? meta.value.join(', \n') : meta.value}} </td>
                                        </tr>
                                    </template>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
<div class="col-md-6 ">


                    <div v-if="item && item.attributes &&  item.attributes.content" v-for="(itemo, index) in item.attributes.content" class="symbol-target" :id="index.toLowerCase().replace(' ', '')">

                        <div class="table-responsive m-b-20  bg-white">
                            <table class="table table-bordered table-striped table-xs m-b-0">
                                <thead class="bg-white">
                                    <tr>
                                        <th scope="col" colspan="2">{{index}} <i class="fa fa-cog text-right" style="
    float: right;
    vertical-align: middle;
    font-size: 16px;
"></i></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(meta, key) in itemo">
                                        <tr :key="key">
                                            <td>{{meta.key}}</td>
                                            <td v-html="Array.isArray(meta.value) ? meta.value.join('<br>') : meta.value"> {{Array.isArray(meta.value) ? meta.value.join(', \n') : meta.value}} </td>
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
</div>
</template>

<script>
module.exports = {
    name: "single",
    props: ['itemId'],
    data() {
        return {
            item: {},
            prices: [{
                    "store": "teknosa",
                    "title": "Garmin Fenix 5S Sapphire",
                    "price": "300.50",
                    "storeLogo": "https://www.epey.com/resim/site/teknosa-com.png",
                    "outUrl": "https://www.cimri.com/cep-telefonlari/en-ucuz-huawei-cep-telefonlari-fiyatlari",
                    "attributes": {
                        "freeCargo": true
                    }
                },
                {
                    "store": "n11",
                    "title": "Garmin Fenix 5S Sapphire",
                    "price": "300.50",
                    "storeLogo": "https://www.epey.com/resim/site/urun-n11-com.png",
                    "outUrl": "https://www.cimri.com/cep-telefonlari/en-ucuz-huawei-cep-telefonlari-fiyatlari",
                    "attributes": {
                        "freeCargo": true
                    }
                },
                {
                    "store": "amazon",
                    "title": "Garmin Fenix 5S Sapphire",
                    "price": "300.50",
                    "storeLogo": "https://www.epey.com/resim/site/amazon-com-tr.png",
                    "outUrl": "https://www.cimri.com/cep-telefonlari/en-ucuz-huawei-cep-telefonlari-fiyatlari",
                    "attributes": {
                        "freeCargo": true
                    }
                },
                {
                    "store": "mediamarkt",
                    "title": "Garmin Fenix 5S Sapphire",
                    "price": "300.50",
                    "storeLogo": "https://www.epey.com/resim/site/mediamarkt-com-tr.png",
                    "outUrl": "https://www.cimri.com/cep-telefonlari/en-ucuz-huawei-cep-telefonlari-fiyatlari",
                    "attributes": {
                        "freeCargo": true
                    }
                },
                {
                    "store": "trendyol",
                    "title": "Garmin Fenix 5S Sapphire",
                    "price": "300.50",
                    "storeLogo": "https://www.epey.com/resim/site/https-trendyol-com.png",
                    "outUrl": "https://www.cimri.com/cep-telefonlari/en-ucuz-huawei-cep-telefonlari-fiyatlari",
                    "attributes": {
                        "freeCargo": true
                    }
                }
            ],
            example: 0,
        };
    },
    computed: {},
    mounted() {

    },
    beforeCreate() {},
    created() {
        this.get(apiUrl + '/entry/' + this.$route.params.itemId, (res) => {
            console.log(res);

            this.item = res
        });
    },
    methods: {}
}
</script>

<style>
.table>tbody>tr>td,
.table>tfoot>tr>td,
.table>thead>tr>td {
    padding: 5px 12px;
}

.nav-pills .nav-item.show .nav-link,
.nav-pills .nav-link.active {
    background-color: #ff5722;
}

.s98wa6g-2 {
    background-color: rgb(255, 87, 34);
    padding: 10px;
    vertical-align: middle;
    text-align: center;
    margin-top: 20px;
    color: white;
    font-weight: 600;
}

.nav-pills .nav-item.show .nav-link,
.nav-pills .nav-link.active {
    background-color: #ffffff;
    color: black;
    border-bottom: 1px solid #ff5722;
    border-radius: 0;
}

.nav-pills .nav-item .nav-link,
.nav-pills .nav-link {
    background-color: #ffffff;
    color: black;
    font-weight: 600;
}

i.fa.fa-star {
    color: #FFC107;
    font-size: 1.2rem;
}
</style>
