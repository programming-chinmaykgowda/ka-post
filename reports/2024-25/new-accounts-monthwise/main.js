function loadRegions() {
    $.ajax({
        type: "GET",
        url: "getregions.php",
        success: function(response) {
            var regions = JSON.parse(response);
            var regionDropdown = $('#region');
            regionDropdown.empty();
            regionDropdown.append('<option value="all">Select Region</option>');
            regionDropdown.append('<option value="all">All Regions</option>');
            regions.forEach(function(region) {
                regionDropdown.append('<option value="' + region.id + '">' + region.name + '</option>');
            });
            loadDivisions();
        }
    });
}

var searchTimeout;

function search() {
  clearTimeout(searchTimeout)
  searchTimeout = setTimeout(() => loadData(), 800);
}

function loadOfficeTypes() {
    $.ajax({
        type: "GET",
        url: "getofficetypes.php",
        success: function(response) {
            var officeTypes = JSON.parse(response);
            var officeTypeDropdown = $('#officeType');
            officeTypeDropdown.empty();
            officeTypeDropdown.append('<option value="all">Select Office Types</option>');
            officeTypeDropdown.append('<option value="all">All</option>');
            officeTypes.forEach(function(officeType) {
                officeTypeDropdown.append('<option value="' + officeType + '">' + officeType + '</option>');
            });
        }
    });
}


function loadDivisions() {
    var region = $('#region').val();
    $.ajax({
        type: "GET",
        url: "getdivisions.php",
        data: {
            region: region
        },
        success: function(response) {
            var divisions = JSON.parse(response);
            var divisionDropdown = $('#division');
            divisionDropdown.empty();
            if (region === "all") divisionDropdown.append('<option value="">Select Division</option>');
            divisionDropdown.append('<option value="all">All Divisions</option>');
            divisions.forEach(function(division) {
                divisionDropdown.append('<option value="' + division.id + '">' + division.name + '</option>');
            });
            loadSubdivisions();
        }
    });
}

function loadSubdivisions() {
    var region = $('#region').val();
    var division = $('#division').val();
    $.ajax({
        type: "GET",
        url: "getsubdivisions.php",
        data: {
            region: region,
            division: division
        },
        success: function(response) {
            var subdivisions = JSON.parse(response);
            var subdivisionDropdown = $('#subdivision');
            subdivisionDropdown.empty();

            if (division == "all" || division == "") subdivisionDropdown.append('<option value="">Select Sub Division</option>');
            subdivisionDropdown.append('<option value="all">All Sub Divisions</option>');
            subdivisions.forEach(function(subdivision) {
                subdivisionDropdown.append('<option value="' + subdivision.id + '">' + subdivision.name + '</option>');
            });
        }
    });
    loadAONames();
}

function loadAONames() {
    var region = $('#region').val();
    var division = $('#division').val();
    var subdivision = $('#subdivision').val();
    $.ajax({
        type: "GET",
        url: "getaonames.php",
        data: {
            region: region,
            division: division,
            subdivision: subdivision
        },
        success: function(response) {
            var aonames = JSON.parse(response);
            var aonameDropdown = $('#aoname');
            aonameDropdown.empty();
            aonameDropdown.append('<option value="">Select Office</option>');
            aonameDropdown.append('<option value="all_acs">All Account Offices</option>');
            aonameDropdown.append('<option value="all">All Offices</option>');
            aonames.forEach(function(aoname) {
                aonameDropdown.append('<option value="' + aoname.id + '">' + aoname.name + '</option>');
            });
        }
    });
}

function getFieldNameFromSQL(sortBy) {
    return $("[data-backendName='" + sortBy + "']").text();
}


function addSortedIcons() {
    const tableHeaders = document.querySelectorAll("th")

    var sortBy = $("#sortBy").val();

    const order = sortBy.split(" ")[1]

    for (let i = 0; i < tableHeaders.length; i++) {
        if (tableHeaders[i].innerHTML.replaceAll("<br>", "").startsWith(getFieldNameFromSQL(sortBy.split(" ")[0]))) {
            if (order === "ASC") {
                tableHeaders[i].innerHTML += `
	      				<div class="sort-icons" data-backendname="${tableHeaders[i].attributes['data-backendname'].value}">
	      					<span class="asc-sort-icon active" data-backendname="${tableHeaders[i].attributes['data-backendname'].value}"></span>
	      					<span class="desc-sort-icon" data-backendname="${tableHeaders[i].attributes['data-backendname'].value}"></span>
	      				</div>
	      			`
            }

            if (order === "DESC") {
                tableHeaders[i].innerHTML += `
	      				<div class="sort-icons" data-backendname="${tableHeaders[i].attributes['data-backendname'].value}">
	      					<span class="asc-sort-icon" data-backendname="${tableHeaders[i].attributes['data-backendname'].value}"></span>
	      					<span class="desc-sort-icon active" data-backendname="${tableHeaders[i].attributes['data-backendname'].value}"></span>
	      				</div>
	      			`
            }
        } else {
            tableHeaders[i].innerHTML += `
      				<div class="sort-icons" data-backendname="${tableHeaders[i].attributes['data-backendname'].value}">
      					<span class="asc-sort-icon" data-backendname="${tableHeaders[i].attributes['data-backendname'].value}"></span>
      					<span class="desc-sort-icon" data-backendname="${tableHeaders[i].attributes['data-backendname'].value}"></span>
      				</div>
      			`
        }
    }
}

function loadData(callback = () => {}) {
    var region = $('#region').val();
    var division = $('#division').val();
    var subdivision = $('#subdivision').val();
    var aoname = $('#aoname').val();
    const officeType = $('#officeType').val();
    var sortBy = $("#sortBy").val();


    if (aoname === "all_acs" && sortBy.startsWith("AO_Name")) {
        sortBy = "Name ASC"
    }

    if (aoname === "" && sortBy.startsWith("Sub_Division")) {
        sortBy = "Name ASC"
    }

    if (subdivision === "" && aoname === "" && sortBy.startsWith("Division")) {
        sortBy = "Name ASC"
    }


    const category = $("#category").val()
    const topBottomOffice = $("#top-bottom-offices").val()
    const searchQuery = $("#search").val()

    $.ajax({
        type: "GET",
        url: "display_data.php",
        data: {
            region: region,
            division: division,
            subdivision: subdivision,
            aoname: aoname,
            sortBy,
            officeType,
            category,
            searchQuery,
            topBottomOffice
        },
        success: function(response) {
            $('#data').html(response);

            const tableDataColumns = document.querySelectorAll("td")
            const tableDataHeaders = document.querySelectorAll("th")

            const resultCount = (tableDataColumns.length / tableDataHeaders.length) - 1;
            $("#result-count").html(resultCount)
            
            if(resultCount == 0) $("#data").html("No Data Found")

            addSortedIcons();

            $("th").click(function(event) {

                var sortByField = $(event.target).data("backendname")

                var sortBy = $("#sortBy").val()

                var sortByOrder = "ASC"

                var sortByQuery = ""

                if (!sortBy.includes(",")) {
                    if (sortBy.startsWith(sortByField)) {
                        if (sortBy.includes("ASC")) {
                            sortByOrder = "DESC"
                        } else {
                            sortByOrder = "ASC"
                        }
                    }

                    sortByQuery += sortByField + " " + sortByOrder
                }

                $("#sortBy").val(sortByQuery);
                loadData()
            })
            
            

            callback()
        }
    });
}

function exportToExcel() {
    loadData(
        () => {
            TableToExcel.convert(document.getElementById("data"), {
                name: `Report.xlsx`,
                sheet: {
                    name: 'Report'
                }
            });
        }
    )
}



$(document).ready(function() {
    loadRegions();
    loadOfficeTypes();
    loadData();
});