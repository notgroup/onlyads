const ScriptStore = [{
    name: "select2",
    src: "assets/libs/select2/js/select2.min.js"
}, {
    name: "flatpickr",
    src: "assets/libs/flatpickr/flatpickr.min.js"
}, {
    name: "touchspin",
    src: "assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"
}, {
    name: "jscrollpane",
    src: "assets/libs/jscrollpane/jquery.jscrollpane.min.js"
}, {
    name: "mousewheel",
    src: "assets/libs/jscrollpane/jquery.mousewheel.js"
}, {
    name: "d3",
    src: "assets/libs/d3/d3.min.js"
}, {
    name: "c3",
    src: "assets/libs/c3js/c3.min.js"
}, {
    name: "noty",
    src: "assets/libs/noty/noty.min.js"
}, {
    name: "maplace",
    src: "assets/libs/maplace/maplace.min.js"
}, {
    name: "fullcalendar",
    src: "assets/libs/fullcalendar/fullcalendar.min.js"
}, {
    name: "momentjs",
    src: "assets/js/lib/moment/moment-with-locales.min.js"
}, {
    name: "plyr",
    src: "assets/libs/plyr/plyr.js"
}, {
    name: "uppy",
    src: "assets/libs/uppy/uppy.min.js"
}, {
    name: "dropzone",
    src: "assets/libs/dropzone/dropzone.min.js"
}, {
    name: "colorpicker",
    src: "assets/libs/jquery-minicolors/jquery.minicolors.min.js"
}, {
    name: "inputmask",
    src: "assets/libs/jquery-mask/jquery.mask.min.js"
}];
let scripts = {};

function scriptLoad(name, cb) {
    if (!scripts[name].loaded) {
        var req = new XMLHttpRequest;
        req.open("GET", scripts[name].src, !1), req.onreadystatechange = function() {
            if (4 == req.readyState) {
                var s = document.createElement("script");
                s.appendChild(document.createTextNode(req.responseText)), scripts[name].loaded = !0, document.head.appendChild(s)
            }
        }, req.send(null)
    }
}

function loadScript(url, callback) {
    var head = document.getElementsByTagName("head")[0],
        script = document.createElement("script");
    script.type = "text/javascript", script.src = url, script.onreadystatechange = callback, script.onload = callback, head.appendChild(script)
}
ScriptStore.forEach(script => {
    scripts[script.name] = {
        loaded: !1,
        src: script.src
    }
});
let yuklenenler = {};

function loadScript2(url, callback) {
    let basladi = Date.now();
    if (yuklenenler[url]) callback("zaten var"), console.log("zaten var", Date.now() - basladi);
    else {
        var script = document.createElement("script");
        script.type = "text/javascript", script.readyState ? script.onreadystatechange = function() {
            "loaded" != script.readyState && "complete" != script.readyState || (script.onreadystatechange = null, callback("yuklendi"), yuklenenler[url] = !0, console.log("yuklendi", Date.now() - basladi))
        } : script.onload = function() {
            callback("yuklendi"), yuklenenler[url] = !0, console.log("yuklendi", Date.now() - basladi)
        }, script.src = url, document.getElementsByTagName("head")[0].appendChild(script)
    }
}

function loadjscssfile(filename, filetype, callback) {
    var fileref;
    if ("js" == filetype)(fileref = document.createElement("script")).setAttribute("type", "text/javascript"), fileref.setAttribute("src", filename);
    else if ("css" == filetype) {
        var fileref;
        (fileref = document.createElement("link")).setAttribute("rel", "stylesheet"), fileref.setAttribute("type", "text/css"), fileref.setAttribute("href", filename)
    }
    void 0 !== fileref && (fileref.readyState ? fileref.onreadystatechange = function() {
        "loaded" != fileref.readyState && "complete" != fileref.readyState || (fileref.onreadystatechange = callback, yuklenenler[url] = !0)
    } : (fileref.onload = callback, yuklenenler[url] = !0)), fileref.onreadystatechange = callback, fileref.onload = callback, document.getElementsByTagName("head")[0].appendChild(fileref)
}
Vue.directive("sortable", {
    bind: el => {
        setTimeout(() => {
            $(el).sortable()
        }, 600)
    }
}), Vue.directive("scrollable", {
    bind: el => {
        setTimeout(() => {
            var jScrollOptions = {
                autoReinitialise: !0,
                autoReinitialiseDelay: 100,
                contentWidth: "0px"
            };
            $(el).jScrollPane(jScrollOptions)
        }, 600)
    }
}), Vue.directive("selectable", {
    bind: el => {
        setTimeout(() => {
            $(el).selectpicker({
                style: "",
                width: "100%",
                size: 8
            })
        }, 600)
    }
}), Vue.directive("tooltip", {
    bind: el => {
        setTimeout(() => {
            $(el).tooltip({
                html: !0
            })
        }, 100)
    }
}), Vue.directive("popover", {
    bind: el => {
        setTimeout(() => {
            $(el).popover({
                trigger: "focus"
            })
        }, 100)
    }
}), Vue.directive("boxTypical", {
    bind: el => {
        setTimeout(() => {
            var parent = $(el),
                btnCollapse = parent.find(".action-btn-collapse"),
                btnExpand = parent.find(".action-btn-expand"),
                classExpand = "box-typical-full-screen";
            btnCollapse.click(() => {
                parent.hasClass("box-typical-collapsed") ? parent.removeClass("box-typical-collapsed") : parent.addClass("box-typical-collapsed")
            }), btnExpand.click(() => {
                parent.hasClass(classExpand) ? (parent.removeClass(classExpand), $("html").css("overflow", "auto")) : (parent.addClass(classExpand), $("html").css("overflow", "hidden"))
            })
        }, 600)
    }
}), Vue.filter("json", value => value ? JSON.stringify(value, null, 2) : value), axios.defaults.baseURL = "//core.me/api", axios.defaults.headers.common.Authorization = "Bearer 123456", Vue.mixin({
    data: () => ({
        defaultData2: "aslan",
        informations: {
            root: "deneme"
        }
    }),
    methods: {
        updateRoot: function(key_name, key_value) {
            this.informations[key_name] = key_value
        },
        getLocalData: function(meta_key, cb) {
            localforage.getItem("site_settings_" + localStorage.getItem("restaurant_id")).then(data => cb(data[meta_key]))
        },
        axios_test: function(url, pdata, cb) {
            axios.post(url, pdata).then((function(response) {
                cb(response)
            })).catch((function(error) {
                console.log(error)
            }))
        },
        post: function(url, pdata, cb) {
            fetch(url, {
                headers: {
                    "content-type": "application/json"
                },
                method: "post",
                body: JSON.stringify(pdata)
            }).then(response => response.json()).then(data => {
                cb(data)
            })
        }
    },
    computed: {
        infor_data: function() {
            return this.informations
        }
    },
    mounted() {},
    beforeCreate() {},
    created() {},
    beforeUpdate() {},
    updated() {},
    filters: {},
    components: {},
    store: new Vuex.Store({
        state: {
            count: 100,
            genel: {
                bilgi: "yok"
            },
            ekle2: {},
            datalar: {}
        },
        mutations: {
            increment({
                state: state
            }) {
                state.count++
            },
            dataEkle(state, data) {
                state.datalar = data
            }
        },
        actions: {
            ekle({
                commit: commit,
                state: state
            }, bilgi) {
                state.genel.yeni = bilgi
            },
            ekle2({
                commit: commit,
                state: state
            }, bilgi) {
                state.ekle2 = bilgi
            }
        }
    })
}), localStorage.setItem("restaurant_id", 3), localforage.config({
    driver: localforage.INDEXEDDB,
    name: "restaurant_manage",
    version: 1,
    storeName: "restaurant_db",
    description: "açıklama"
});
var store = localforage.createInstance({
    driver: localforage.INDEXEDDB,
    name: "restaurant_1",
    version: 1,
    storeName: "restaurant_1_db",
    description: "açıklama"
});
