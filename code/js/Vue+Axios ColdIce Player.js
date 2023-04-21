/*
    歌曲搜索接口：
    请求URL：https://autumnfish.cn/search
    请求方式：GET
    请求参数：keywords
    返回参数：歌曲搜索结果
*/
/*
    歌曲url获取接口
    请求地址:https://autumnfish.cn/song/url
    请求方法:get
    请求参数:id(歌曲id)
    响应内容:歌曲url地址
*/
/*
    歌曲详情获取接口
    请求地址:https://autumnfish.cn/song/detail
    请求方法:get
    请求参数:ids(歌曲id)
    响应内容:歌曲详情(包括封面信息)
*/
/*
    热门评论获取
    请求地址:https://autumnfish.cn/comment/hot?type=0
    请求方法:get
    请求参数:id(歌曲id,地址中的type固定为0)
    响应内容:歌曲的热门评论
*/
/*
    MV地址获取
    请求地址:https://autumnfish.cn/mv/url
    请求方法:get
    请求参数:id(mvid,为0表示没有mv)
    响应内容:mv的地址
*/
var app = new Vue({
    el: "#player",
    data: {
        query: "",
        musicList: [],
        musicUrl: "",
        musicCover: "",
        hotComments: [],
        isPlaying: false,
        // 遮罩层显示状态
        isShow: false,
        mvUrl: "",
    },
    methods: {
        searchMusic: function () {
            var that = this;
            axios.get("https://autumnfish.cn/search?keywords=" + this.query)
                .then(function (response) {
                    // console.log(response);
                    console.log(response.data.result.songs);
                    that.musicList = response.data.result.songs;
                }, function (err) { })
        },
        playMusic: function (musicId) {
            // console.log(musicId);
            var that = this;
            axios.get("https://autumnfish.cn/song/url?id=" + musicId)
                .then(function (response) {
                    // console.log(response.data.data[0].url);
                    that.musicUrl = response.data.data[0].url;
                }, function (err) { })

            axios.get("https://autumnfish.cn/song/detail?ids=" + musicId)
                .then(function (response) {
                    // console.log(response.data.songs[0].al.picUrl);
                    that.musicCover = response.data.songs[0].al.picUrl;
                }, function (err) { })

            axios.get("https://autumnfish.cn/comment/hot?type=0&id=" + musicId)
                .then(function (response) {
                    // console.log(response);
                    console.log(response.data.hotComments);
                    that.hotComments = response.data.hotComments;
                }, function (err) { })
        },
        play: function () {
            console.log("play");
            this.isPlaying = true;
        },
        pause: function () {
            console.log("pause")
            this.isPlaying = false;
        },
        playMv: function (mvid) {
            var that = this;
            axios.get("https://autumnfish.cn/mv/url?id=" + mvid)
                .then(function (response) {
                    console.log(response.data.data.url);
                    that.isShow = true;
                    that.mvUrl = response.data.data.url;
                    // 暂停歌曲播放
                    that.$refs.audio.pause();
                }, function (err) { })

        },
        hideMv: function () {
            this.isShow = false;
            this.$refs.video.pause();
        }
    }
})