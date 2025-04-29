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
  {
    id: 19,
    vprasanje: "Kaj bi si želeli za razvoj {{ ime }} v prihodnje?",
  },
  {
    id: 20,
    vprasanje: "Ali obstajajo posebne potrebe ali opažanja glede {{ ime }}?",
  },
];
/*
vzgojiteljice: [{ id: 11, ime: "Ajda", vprasanja: [], spremnoBesedilo : "" }], // placeholder
*/
var raw_odgovori = [
  {
    id: 1,
    ime: "Gašper",
    odgovori: [
      { id: 1, vprasanje: "Ali si danes zajtrkoval?", odgovor: "Da, zjutraj sem pojedel kruh z maslom in marmelado ter popil kozarec mleka. Zajtrk mi je dal energijo za cel dan." },
      { id: 2, vprasanje: "Ali si se danes dobro naspal?", odgovor: "Ne ravno. Ponoči sem se večkrat zbudil, ker je zunaj močno deževalo in me je motil hrup vetra." },
      { id: 3, vprasanje: "Ali imaš rad čokolado?", odgovor: "Da, zelo. Najraje imam mlečno čokolado z lešniki, še posebej, kadar jo pojem skupaj z banano." },
      { id: 4, vprasanje: "Ali si danes bil v šoli?", odgovor: "Ne, danes sem ostal doma, ker sem bil nekoliko prehlajen. Upam, da bom jutri že bolje in bom lahko šel." },
      { id: 5, vprasanje: "Ali si danes srečal prijatelja?", odgovor: "Da, srečal sem Marka na igrišču. Igrala sva nogomet in se zabavala skoraj celo popoldne." },
      { id: 6, vprasanje: "Ali si danes kaj narisal?", odgovor: "Ne, danes nisem risal, ampak sem se ukvarjal z lego kockami. Sestavil sem hišo in vesoljsko ladjo." },
      { id: 7, vprasanje: "Ali si pojedel sadje?", odgovor: "Da, pojedel sem dve jabolki in eno banano. Mama pravi, da je sadje zelo pomembno za zdravje." },
      { id: 8, vprasanje: "Ali si se danes igral zunaj?", odgovor: "Da, šel sem na sprehod s psom in potem še s sosedi igral skrivalnice na vrtu. Bilo je zelo zabavno." },
      { id: 9, vprasanje: "Ali si poslušal učiteljico?", odgovor: "Da, trudil sem se biti pozoren pri pouku. Danes smo se učili o planetih in bilo je zelo zanimivo." },
      { id: 10, vprasanje: "Ali si danes srečen?", odgovor: "Da, ker sem preživel dan s svojo družino in prijatelji, pa tudi zato, ker sem pojedel najljubšo večerjo – špagete." }
    ]
    
  },
  {
    id: 1,
    ime: "Zoki",
    odgovori: [
      { id: 1, vprasanje: "Ali si danes zajtrkoval?", odgovor: "NE" },
      { id: 2, vprasanje: "Ali si se danes dobro naspal?", odgovor: "NE" },
      { id: 3, vprasanje: "Ali imaš rad čokolado?", odgovor: "Da" },
      { id: 4, vprasanje: "Ali si danes bil v šoli?", odgovor: "Ne" },
      { id: 5, vprasanje: "Ali si danes srečal prijatelja?", odgovor: "Da" },
      { id: 6, vprasanje: "Ali si danes kaj narisal?", odgovor: "Ne" },
      { id: 7, vprasanje: "Ali si pojedel sadje?", odgovor: "Da" },
      { id: 8, vprasanje: "Ali si se danes igral zunaj?", odgovor: "Da" },
      { id: 9, vprasanje: "Ali si poslušal učiteljico?", odgovor: "Da" },
      { id: 10, vprasanje: "Ali si danes srečen?", odgovor: "Da" }
    ]
  }
];


const { createApp } = Vue;

createApp({
  data() {
    return {
      odgovori: raw_odgovori,
      // data za vprasalnik
      // vzgojiteljice
      vzgojiteljice: [], // placeholder
      imeVzgojiteljice: "",
      // odgovori
      modal_odgovori: {}, // modal za odgovore
      modal_odgovor_edit: [], // modal za odgovore


      // vprašanja
      vprasanja: raw_vprasanja,
      dodatnaVprasanja: [], // dodatna vprašanja
      dodatnoVprasanje: "", // dodatno vprašanje (vpis)
      dodatnoVprasanjeIme: "", // ime vzgojiteljice, ki je dodala dodatno vprašanje
    };
  },
  methods: {
    // metoda za dodajanje vzgojiteljice
    dodajVzgojiteljico() {
      var dodaj_indexe_vprasanj = []; // indeksi vprašanj, ki jih je izbrala vzgojiteljica
      this.vprasanja.forEach((vprasanje) => {
        dodaj_indexe_vprasanj.push(vprasanje.id); // dodaj indeks vprašanja
      });

      this.vzgojiteljice.push({
        id: "NOVO",
        ime: this.imeVzgojiteljice,
        vprasanja: dodaj_indexe_vprasanj,
        spremnoBesedilo: "",
      });
      this.imeVzgojiteljice = ""; // ponastavi vnosno polje
    },
    // metoda za brisanje vzgojiteljice
    izbrisiVzgojiteljico(index) {
      this.vzgojiteljice.splice(index, 1);
    },
    // metoda za shranjevanje podatkov
    shraniPodatke() {
      console.log(this.vzgojiteljice);
      alert("Podatki so shranjeni!");
    },
    replaceName(text, ime) {
      // zamenja {{ v.ime }} z imenom vzgojiteljice
      return text.replace(/{{\s*ime\s*}}/g, ime);
    },
    izberiOdstrani(id, ime) {
      // izbere ali odstrani vprašanje
      const index = this.vzgojiteljice.findIndex((v) => v.ime === ime);
      if (index !== -1) {
        const vzgojiteljica = this.vzgojiteljice[index];
        const vprasanjeIndex = vzgojiteljica.vprasanja.indexOf(id);
        if (vprasanjeIndex !== -1) {
          vzgojiteljica.vprasanja.splice(vprasanjeIndex, 1); // odstrani vprašanje
        } else {
          vzgojiteljica.vprasanja.push(id); // doda vprašanje
        }
      }
    },
    pripraviZaDodatnoVprasanje(ime) {
        this.dodatnoVprasanjeIme = ime; // zasasno shrani ime vzgojiteljice
    },
    dodajVprasanje() {
        this.dodatnaVprasanja.push({
            id: this.dodatnaVprasanja.length + 1,
            ime: this.dodatnoVprasanjeIme,
            vprasanje: this.dodatnoVprasanje,
        });
        this.dodatnoVprasanje = ""; // ponastavi vnosno polje
    },
    izberiOdstraniDODATNE(id) {
        // izbere ali odstrani dodatno vprašanje
        const index = this.dodatnaVprasanja.findIndex((v) => v.id === id);
        if (index !== -1) {
          this.dodatnaVprasanja.splice(index, 1); // odstrani vprašanje
        }
    },
    dodatnaVprasanjaByName(ime) {
        // vrne dodatna vprašanja za dano ime vzgojiteljice
        return this.dodatnaVprasanja.filter((v) => v.ime === ime);
    },
    KopirajNabor(index) {
        this.vzgojiteljice[index].vprasanja = [...this.vzgojiteljice[0].vprasanja]; // kopira vprašanja iz prve vzgojiteljice
    },
    pripraviModal(odgovor) {
      this.modal_odgovori = odgovor; // pripravi modal za odgovore
      this.modal_odgovor_edit = []; // ponastavi modal za odgovore
    },
    uredi_odgovor(index) {
      this.modal_odgovor_edit.push(index); // shrani indeks odgovora, ki ga urejamo
    }
  },
}).mount("#app");
