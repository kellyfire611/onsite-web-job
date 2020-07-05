new Vue({
  el: '#bar',
  delimiters: ['${', '}'],
  data() {
    return {
      search: null,
      windowWidth: 0,
    };
  },
  mounted() {
    this.onResize();
    this.$nextTick(() => {
      window.addEventListener('resize', this.onResize);
    });
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.onResize);
  },
  methods: {
    onResize() {
      this.windowWidth = window.innerWidth;
    },
  },
  computed: {
    isSmall() {
      return this.windowWidth < 992;
    },
  },
});
