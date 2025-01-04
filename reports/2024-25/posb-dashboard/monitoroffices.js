  const { createApp } = Vue

  createApp({
    async mounted() {
      const getOffices = await fetch("getoffices.php?fetchBy=all")
      
      const getOfficesRes = await getOffices.json()
      
      this.backendRes = getOfficesRes
      
      const getOfficeTypes = await fetch("getofficetypes.php")
      
      const getOfficeTypesRes = await getOfficeTypes.json()
      
      this.officeTypes = getOfficeTypesRes
      
      var $divs = $('.scroller1, .scroller2, .scroller3');
			var timeout;
			var sync = function(e){
					$divs = $('.scroller1, .scroller2, .scroller3');
					clearTimeout(timeout)
			    var $other = $divs.not(this).off('scroll'), 
			        percentage = this.scrollLeft / (this.scrollWidth - this.offsetWidth);
			
			    $other.each(function (index, other) {
			        other.scrollLeft= percentage * (other.scrollWidth - other.offsetWidth);
			    });
			    timeout = setTimeout( function(){ $other.on('scroll', sync ); },10);
			}
			$divs.on( 'scroll', sync);   
    },
    data() {
      return {
        backendRes: {count: {}, names: {}},
        regionAccordion: false,
        divisionAccordion: false,
        subdivisionAccordion: false,
        fetchBy: "all",
        officeTypes: [],
        aoAccordion: false
      }
    },
    methods: {
      async fetch(event) {
        this.fetchBy = event.target.value;
        const getOffices = await fetch(`getoffices.php?fetchBy=${event.target.value}`)
      
        const getOfficesRes = await getOffices.json()
        
        this.backendRes = getOfficesRes   
      }
    },
    template: `
    <div>
      <label>Fetch BY: </label>
      <select @change="fetch" id="fetchby" :value="fetchBy">
      
        <option value="all">Select Office Type</option>
        <option value="all">All</option>
        <option v-for="officeType in officeTypes">{{ officeType }}</option>
      </select>
    </div><br />
    <div class="table" v-show="officeTypes.length">
      <div class="table-row" class="scroller1">
          <h3>Name</h3>
          <h3>0 A/cs</h3>
          <h3>1 to 25 A/cs</h3>
          <h3>26 to 50 A/cs</h3>
          <h3>51 to 100 A/cs</h3>
          <h3>101 to 200 A/cs</h3>
          <h3>201 to 500 A/cs</h3>
          <h3>501 to 1000 A/cs</h3>
          <h3>1001 to 2000 A/cs</h3>
          <h3>2001 to 5000 A/cs</h3>
          <h3>>5000 A/cs</h3>
          <h3>Total Offices</h3>
      </div>
      <div v-for="region,index in Object.keys(backendRes.names)" class="scroller2">
        <div @click="this.regionAccordion = regionAccordion == region ? false : region" class="table-row">
          <h3><button class="toggler">{{ regionAccordion == region  ? "-" : "+" }}</button>{{ backendRes.idNameMapping.region[region] }}</h3>
          <h3>{{ backendRes.count.region[region]["0"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region][">0<26"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region][">25<51"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region][">50<101"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region][">100<201"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region][">200<501"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region][">500<1001"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region][">1000<2001"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region][">2000<5001"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region][">5000"] ?? "" }}</h3>
          <h3>{{ backendRes.count.region[region]["total"] ?? "" }}</h3>
        </div>
        <div v-if="regionAccordion == region" v-for="division in Object.keys(backendRes.names[region])">
          <div @click="this.divisionAccordion = divisionAccordion == division ? false : division" class="table-row">
            <h3 style="padding-left: 1vw;"><button class="toggler">{{ divisionAccordion == division  ? "-" : "+" }}</button>{{ backendRes.idNameMapping.division[division] }}</h3>
            <h3>{{ backendRes.count.division[division]["0"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division][">0<26"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division][">25<51"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division][">50<101"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division][">100<201"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division][">200<501"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division][">500<1001"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division][">1000<2001"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division][">2000<5001"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division][">5000"] ?? "" }}</h3>
            <h3>{{ backendRes.count.division[division]["total"] ?? "" }}</h3>
          </div>
          <div v-if="divisionAccordion == division"  v-for="subdivision in Object.keys(backendRes.names[region][division])">
          <div @click="this.subdivisionAccordion = subdivisionAccordion == subdivision ? false : subdivision" class="table-row">
            <h3 style="padding-left: 1.75vw;"><button class="toggler">{{ subdivisionAccordion == subdivision  ? "-" : "+" }}</button>{{ backendRes.idNameMapping.subdivision[subdivision] }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision]["0"] ?? "" }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision][">0<26"] ?? ""}}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision][">25<51"] ?? "" }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision][">50<101"] ?? "" }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision][">100<201"] ?? "" }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision][">200<501"] ?? "" }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision][">500<1001"] ?? "" }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision][">1000<2001"] ?? "" }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision][">2000<5001"] ?? "" }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision][">5000"] ?? "" }}</h3>
            <h3>{{ backendRes.count.subdivision[subdivision]["total"] ?? "" }}</h3>
          </div>
          <div v-if="subdivisionAccordion == subdivision"  v-for="ao in Object.keys(backendRes.names[region][division][subdivision])">
              <div class="table-row" @click="this.aoAccordion = aoAccordion == ao ? false : ao">
                <h3 style="margin-left: 3vw;"><button class="toggler">{{ aoAccordion == ao  ? "-" : "+" }}</button>{{ backendRes.idNameMapping.ao[ao] }}</h3>
                <h3>{{ backendRes.count.ao[ao]["0"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao][">0<26"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao][">25<51"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao][">50<101"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao][">100<201"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao][">200<501"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao][">500<1001"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao][">1000<2001"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao][">2000<5001"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao][">5000"] ?? "" }}</h3>
                <h3>{{ backendRes.count.ao[ao]["total"] ?? "" }}</h3>
              </div>
              <div v-if="aoAccordion == ao"  v-for="office in backendRes.names[region][division][subdivision][ao]">
                <div class="table-row">
                  <h3 style="margin-left: 4.5vw;">{{ backendRes.idNameMapping.office[office] }}</h3>
                  <h3>{{ backendRes.count.office[office]["0"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office][">0<26"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office][">25<51"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office][">50<101"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office][">100<201"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office][">200<501"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office][">500<1001"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office][">1000<2001"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office][">2000<5001"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office][">5000"] ?? "" }}</h3>
                  <h3>{{ backendRes.count.office[office]["total"] ?? "" }}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="table-row" class="scroller3">
          <h3>Total</h3>
          <h3>{{ backendRes.count.total?.['0'] }}</h3>
          <h3>{{ backendRes.count.total?.['>0<26'] }}</h3>
          <h3>{{ backendRes.count.total?.['>25<51'] }}</h3>
          <h3>{{ backendRes.count.total?.['>50<101'] }}</h3>
          <h3>{{ backendRes.count.total?.['>100<201'] }}</h3>
          <h3>{{ backendRes.count.total?.['>200<501'] }}</h3>
          <h3>{{ backendRes.count.total?.['>500<1001'] }}</h3>
          <h3>{{ backendRes.count.total?.['>1000<2001'] }}</h3>
          <h3>{{ backendRes.count.total?.['>2000<5001'] }}</h3>
          <h3>{{ backendRes.count.total?.['>5000'] }}</h3>
          <h3>{{ backendRes.count.total?.['total'] }}</h3>
      </div> 
      </div>
    </div>
    `
  }).mount('#app')

