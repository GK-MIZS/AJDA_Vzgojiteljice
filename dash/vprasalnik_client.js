var raw_vprasanja = [
  {
    id: 1,
    vprasanje: "Ali ste vzgojiteljica?",
  },
  {
    id: 2,
    vprasanje: "Kaj {{ ime }} najraje je?",
  },
  {
    id: 3,
    vprasanje: "Kako dolgo že delate v vrtcu?",
  },
  {
    id: 4,
    vprasanje: "Kako bi opisali {{ ime }} kot osebo?",
  },
  {
    id: 5,
    vprasanje: "Ali {{ ime }} rad/a sodeluje pri skupinskih dejavnostih?",
  },
  {
    id: 6,
    vprasanje: "Kaj je največji izziv pri delu z otroki?",
  },
  {
    id: 7,
    vprasanje: "Ali {{ ime }} pokaže zanimanje za umetnost ali glasbo?",
  },
  {
    id: 8,
    vprasanje: "Kako se {{ ime }} odziva na spremembe rutine?",
  },
  {
    id: 9,
    vprasanje: "Katera igrača je {{ ime }} najljubša?",
  },
  {
    id: 10,
    vprasanje: "Ali {{ ime }} rad/a pomaga drugim otrokom?",
  },
  {
    id: 11,
    vprasanje: "Kako pogosto {{ ime }} potrebuje spodbudo pri dejavnostih?",
  },
  {
    id: 12,
    vprasanje: "Ali {{ ime }} bolje deluje sam/a ali v skupini?",
  },
  {
    id: 13,
    vprasanje: "Kako bi ocenili komunikacijske spretnosti pri {{ ime }}?",
  },
  {
    id: 14,
    vprasanje: "Ali {{ ime }} pokaže zanimanje za učenje novih stvari?",
  },
  {
    id: 15,
    vprasanje: "Kako {{ ime }} izraža čustva?",
  },
  {
    id: 16,
    vprasanje: "Kako se {{ ime }} vede v konfliktnih situacijah?",
  },
  {
    id: 17,
    vprasanje: "Ali {{ ime }} upošteva navodila in pravila?",
  },
  {
    id: 18,
    vprasanje: "Kaj {{ ime }} najbolj veseli v vrtcu?",
  },
];

var raw_vzgojiteljice = [
  { id: 11, ime: "Ajda", vprasanja: [1, 3, 7, 17, 18], spremnoBesedilo: "", odgovori: [{id: 1, besedilo:""},{id: 3, besedilo:""},{id: 7, besedilo:""},{id: 17, besedilo:""},{id: 18, besedilo:""}] },
  { id: 11, ime: "Taja", vprasanja: [2, 4, 8, 10], spremnoBesedilo: "", odgovori: [{id: 2, besedilo:""},{id: 4, besedilo:""},{id: 8, besedilo:""},{id: 10, besedilo:""}] },
]; // placeholder



const { createApp } = Vue;

createApp({
  data() {
    return {
      // vprašanja
      vzgojiteljice: raw_vzgojiteljice,
      vprasanja: raw_vprasanja,
      imeOtroka: "",
      
    };
  },
  methods: {
    besediloVprasanjaID(id, ime) {
      var result = this.vprasanja.filter((element) => element.id == id);
      if (result.length == 0) {
        return "Napaka: vprašanje ni najdeno!";
      }

      return result[0].vprasanje.replace(/{{\s*ime\s*}}/g, ime);
    },
  },
}).mount("#app_vpr");
