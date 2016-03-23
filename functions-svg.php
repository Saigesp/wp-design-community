<?php 
function the_svg_icon ($icon, $class = ''){
  if($class != '') {
    $class = 'icon icon--'.$icon.' '.$class;
  }else{
	$class = 'icon icon--'.$icon;
  }
  switch ($icon) {
  	case "hamburguer" : echo '<svg version="1.1" id="hamburguer" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		   width="124px" height="124px" viewBox="0 0 124 124" style="enable-background:new 0 0 124 124;" xml:space="preserve">
		  <path d="M112,6H12C5.4,6,0,11.4,0,18s5.4,12,12,12h100c6.6,0,12-5.4,12-12S118.6,6,112,6z"/>
		  <path d="M112,50H12C5.4,50,0,55.4,0,62c0,6.6,5.4,12,12,12h100c6.6,0,12-5.4,12-12C124,55.4,118.6,50,112,50z"/>
		  <path d="M112,94H12c-6.6,0-12,5.4-12,12s5.4,12,12,12h100c6.6,0,12-5.4,12-12S118.6,94,112,94z"/>
		</svg>'; break;
  	case "kebab" : echo '<svg version="1.1" id="kebab" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
			<circle cx="50" cy="50" r="9.965"/>
			<circle cx="50" cy="80" r="9.965"/>
			<circle cx="50" cy="20" r="9.965"/>
		</svg>'; break;
	case "doner" : echo '<svg version="1.1" id="doner" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
			<circle cx="50" cy="80" r="9.965"/>
			<path d="M82.296,20.018c0,5.513-4.468,9.982-9.982,9.982H27.687c-5.513,0-9.982-4.469-9.982-9.982l0,0
				c0-5.513,4.469-9.982,9.982-9.982h44.627C77.828,10.035,82.296,14.504,82.296,20.018L82.296,20.018z"/>
			<path d="M71.473,50c0,5.514-4.468,9.982-9.982,9.982H38.51c-5.513,0-9.982-4.469-9.982-9.982l0,0c0-5.513,4.469-9.982,9.982-9.982
				h22.98C67.005,40.018,71.473,44.487,71.473,50L71.473,50z"/>
			</svg>'; break;
	case 'share' : echo '<svg version="1.1" id="share" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 viewBox="0 0 525.152 525.152" style="enable-background:new 0 0 525.152 525.152;" xml:space="preserve">
			<g>
				<path d="M420.735,371.217c-20.021,0-37.942,7.855-51.596,20.24L181.112,282.094c1.357-6.061,2.407-12.166,2.407-18.468
					c0-6.302-1.072-12.385-2.407-18.468l185.904-108.335c14.179,13.129,32.931,21.334,53.719,21.334
					c43.828,0,79.145-35.251,79.145-79.079C499.88,35.338,464.541,0,420.735,0c-43.741,0-79.079,35.338-79.079,79.057
					c0,6.389,1.072,12.385,2.407,18.468L158.158,205.947c-14.201-13.194-32.931-21.378-53.741-21.378
					c-43.828,0-79.145,35.317-79.145,79.057s35.317,79.079,79.145,79.079c20.787,0,39.54-8.206,53.719-21.334l187.698,109.604
					c-1.291,5.58-2.101,11.4-2.101,17.199c0,42.45,34.594,76.979,76.979,76.979c42.428,0,77.044-34.507,77.044-76.979
					S463.163,371.217,420.735,371.217z"/>
			</g>
		</svg>'; break;
    case "edit" : echo '<svg version="1.1" id="edit" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="18px"
					 viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
				<path d="M617.8,203.4l175.8,175.8l-445,445L172.9,648.4L617.8,203.4z M927,161l-78.4-78.4c-30.3-30.3-79.5-30.3-109.9,0l-75.1,75.1
					l175.8,175.8l87.6-87.6C950.5,222.4,950.5,184.5,927,161z M80.9,895.5c-3.2,14.4,9.8,27.3,24.2,23.8L301,871.8L125.3,696L80.9,895.5
					z"/>
				</svg>'; break;
	case 'close' : echo '<svg version="1.1" id="close" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
				<path d="M79.851,65.758L64.09,49.997l14.163-14.164c3.892-3.892,3.892-10.201,0-14.092c-3.892-3.892-10.2-3.892-14.092,0
					L49.997,35.905L35.833,21.741c-3.892-3.892-10.201-3.892-14.092,0c-3.892,3.892-3.892,10.201,0,14.092l14.164,14.164L20.144,65.758
					l0.188,0.188c-2.401,3.846-1.939,8.971,1.403,12.314c3.344,3.343,8.469,3.805,12.314,1.403l0.188,0.188L49.997,64.09l15.761,15.761
					l0.188-0.188c3.846,2.401,8.971,1.939,12.314-1.403c3.343-3.344,3.805-8.469,1.403-12.314L79.851,65.758z"/>
			</svg>'; break;
	case "gplus" : echo '<svg version="1.1" id="gplus_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 width="96.828px" height="96.827px" viewBox="0 0 96.828 96.827" style="enable-background:new 0 0 96.828 96.827;"
		 xml:space="preserve">
			<path d="M62.617,0H39.525c-10.29,0-17.413,2.256-23.824,7.552c-5.042,4.35-8.051,10.672-8.051,16.912
				c0,9.614,7.33,19.831,20.913,19.831c1.306,0,2.752-0.134,4.028-0.253l-0.188,0.457c-0.546,1.308-1.063,2.542-1.063,4.468
				c0,3.75,1.809,6.063,3.558,8.298l0.22,0.283l-0.391,0.027c-5.609,0.384-16.049,1.1-23.675,5.787
				c-9.007,5.355-9.707,13.145-9.707,15.404c0,8.988,8.376,18.06,27.09,18.06c21.76,0,33.146-12.005,33.146-23.863
				c0.002-8.771-5.141-13.101-10.6-17.698l-4.605-3.582c-1.423-1.179-3.195-2.646-3.195-5.364c0-2.672,1.772-4.436,3.336-5.992
				l0.163-0.165c4.973-3.917,10.609-8.358,10.609-17.964c0-9.658-6.035-14.649-8.937-17.048h7.663c0.094,0,0.188-0.026,0.266-0.077
				l6.601-4.15c0.188-0.119,0.276-0.348,0.214-0.562C63.037,0.147,62.839,0,62.617,0z M34.614,91.535
				c-13.264,0-22.176-6.195-22.176-15.416c0-6.021,3.645-10.396,10.824-12.997c5.749-1.935,13.17-2.031,13.244-2.031
				c1.257,0,1.889,0,2.893,0.126c9.281,6.605,13.743,10.073,13.743,16.678C53.141,86.309,46.041,91.535,34.614,91.535z
				 M34.489,40.756c-11.132,0-15.752-14.633-15.752-22.468c0-3.984,0.906-7.042,2.77-9.351c2.023-2.531,5.487-4.166,8.825-4.166
				c10.221,0,15.873,13.738,15.873,23.233c0,1.498,0,6.055-3.148,9.22C40.94,39.337,37.497,40.756,34.489,40.756z"/>
			<path d="M94.982,45.223H82.814V33.098c0-0.276-0.225-0.5-0.5-0.5H77.08c-0.276,0-0.5,0.224-0.5,0.5v12.125H64.473
				c-0.276,0-0.5,0.224-0.5,0.5v5.304c0,0.275,0.224,0.5,0.5,0.5H76.58V63.73c0,0.275,0.224,0.5,0.5,0.5h5.234
				c0.275,0,0.5-0.225,0.5-0.5V51.525h12.168c0.276,0,0.5-0.223,0.5-0.5v-5.302C95.482,45.446,95.259,45.223,94.982,45.223z"/>
		</svg>'; break;
	case "twitter" : echo '<svg version="1.1" id="twitter_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
			<path d="M612,116.258c-22.525,9.981-46.694,16.75-72.088,19.772c25.929-15.527,45.777-40.155,55.184-69.411
				c-24.322,14.379-51.169,24.82-79.775,30.48c-22.907-24.437-55.49-39.658-91.63-39.658c-69.334,0-125.551,56.217-125.551,125.513
				c0,9.828,1.109,19.427,3.251,28.606C197.065,206.32,104.556,156.337,42.641,80.386c-10.823,18.51-16.98,40.078-16.98,63.101
				c0,43.559,22.181,81.993,55.835,104.479c-20.575-0.688-39.926-6.348-56.867-15.756v1.568c0,60.806,43.291,111.554,100.693,123.104
				c-10.517,2.83-21.607,4.398-33.08,4.398c-8.107,0-15.947-0.803-23.634-2.333c15.985,49.907,62.336,86.199,117.253,87.194
				c-42.947,33.654-97.099,53.655-155.916,53.655c-10.134,0-20.116-0.612-29.944-1.721c55.567,35.681,121.536,56.485,192.438,56.485
				c230.948,0,357.188-191.291,357.188-357.188l-0.421-16.253C573.872,163.526,595.211,141.422,612,116.258z"/>
		</svg>'; break;
	case 'arroba' : echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve"><g><path d="M20.111 26.147c-2.336 1.051-4.361 1.401-7.125 1.401c-6.462 0-12.146-4.633-12.146-12.265 c0-7.94 5.762-14.833 14.561-14.833c6.853 0 11.8 4.7 11.8 11.252c0 5.684-3.194 9.265-7.399 9.3 c-1.829 0-3.153-0.934-3.347-2.997h-0.077c-1.208 1.986-2.96 2.997-5.023 2.997c-2.532 0-4.361-1.868-4.361-5.062 c0-4.749 3.504-9.071 9.111-9.071c1.713 0 3.7 0.4 4.6 0.973l-1.169 7.203c-0.388 2.298-0.116 3.3 1 3.4 c1.673 0 3.773-2.102 3.773-6.58c0-5.061-3.27-8.994-9.303-8.994c-5.957 0-11.175 4.673-11.175 12.1 c0 6.5 4.2 10.2 10 10.201c1.986 0 4.089-0.43 5.646-1.245L20.111 26.147z M16.646 10.1 c-0.311-0.078-0.701-0.155-1.207-0.155c-2.571 0-4.595 2.53-4.595 5.529c0 1.5 0.7 2.4 1.9 2.4 c1.441 0 2.959-1.828 3.311-4.087L16.646 10.068z"/></g></svg>';
		break;
	case 'facebook' : echo '<svg version="1.1" id="facebook_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 width="96.124px" height="96.123px" viewBox="0 0 96.124 96.123" style="enable-background:new 0 0 96.124 96.123;"
		 xml:space="preserve">
		<path d="M72.089,0.02L59.624,0C45.62,0,36.57,9.285,36.57,23.656v10.907H24.037c-1.083,0-1.96,0.878-1.96,1.961v15.803
			c0,1.083,0.878,1.96,1.96,1.96h12.533v39.876c0,1.083,0.877,1.96,1.96,1.96h16.352c1.083,0,1.96-0.878,1.96-1.96V54.287h14.654
			c1.083,0,1.96-0.877,1.96-1.96l0.006-15.803c0-0.52-0.207-1.018-0.574-1.386c-0.367-0.368-0.867-0.575-1.387-0.575H56.842v-9.246
			c0-4.444,1.059-6.7,6.848-6.7l8.397-0.003c1.082,0,1.959-0.878,1.959-1.96V1.98C74.046,0.899,73.17,0.022,72.089,0.02z"/>
		</svg>'; break;
    case "linkedin" : echo '<svg version="1.1" id="linkedin_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 height="18px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
		<path  d="M95,59.727V93H75.71V61.955c0-7.799-2.79-13.121-9.773-13.121c-5.33,0-8.502,3.587-9.897,7.056
			c-0.509,1.241-0.64,2.967-0.64,4.704V93H36.104c0,0,0.26-52.58,0-58.028h19.295v8.225c-0.039,0.062-0.09,0.128-0.127,0.188h0.127
			v-0.188c2.563-3.948,7.141-9.588,17.388-9.588C85.483,33.609,95,41.903,95,59.727z M15.919,7C9.318,7,5,11.33,5,17.024
			c0,5.57,4.193,10.031,10.663,10.031h0.129c6.729,0,10.914-4.46,10.914-10.031C26.579,11.33,22.521,7,15.919,7z M6.146,93h19.289
			V34.972H6.146V93z"/>
		</svg>'; break;
	case 'meneame' : echo '<svg version="1.1" id="meneame_icon" class="'.$class.'" inkscape:version="0.43" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="500px" height="500px"
		 viewBox="47.638 170.945 500 500" enable-background="new 47.638 170.945 500 500" xml:space="preserve">
		<path d="M544.89,251.007c-0.375-7.974-6.19-21.411-7.985-25.386c-8.245-18.251-11.476-18.251-13.211-18.251
			c-1.272,0-2.449,0.587-3.229,1.61c-1.288,1.69-1.985,4.029,1.615,17.13c5.099,25.087,9.092,60.746-14.64,81.284
			c-0.072,0.062-0.14,0.125-0.206,0.192c-14.474,14.681-34.508,23.215-53.882,31.468c-27.151,11.567-55.229,23.527-69.45,52.539
			c-0.062,0.124-0.115,0.251-0.161,0.382c-17.143,48.609,12.947,120.6,34.919,173.164c4.59,10.981,8.925,21.354,12.368,30.407
			c0.042,0.109,0.089,0.217,0.142,0.322c0.85,1.704,0.917,3.351,0.208,5.181c-4.77,12.318-39.265,25.668-62.09,34.501
			c-15.521,6.008-23.86,9.345-27.682,12.418c4.759-11.248,8.497-29.715,10.611-45.188c1.274-9.318,5.05-40.793,0.122-54.57
			c-1.836-5.178-9.234-12.063-52.097-12.063c-30.411,0-67.557,3.746-75.509,6.698c-1.562,0.58-2.509,2.169-2.278,3.817
			c0.231,1.65,1.579,2.917,3.24,3.046c7.144,0.552,15.322,0.811,23.98,1.084c27.683,0.876,62.055,1.963,79.966,13.96
			c3.616,7.009,0.717,33.062-1.415,52.219c-1.683,15.122-2.776,25.63-2.524,32.414c-3.33-4.781-15.812-6.136-43.174-8.051
			c-9.373-0.654-18.226-1.274-24.633-2.196c-7.212-0.816-14.643-1.549-21.829-2.258c-42.727-4.212-86.906-8.569-122.534-33.221
			c-39.345-29.488-42.076-87.137-24.664-126.429c0.02-0.046,0.039-0.092,0.058-0.138c14.15-35.924,36.367-74.831,64.253-112.516
			c1.388,3.964,2.975,7.851,4.783,11.614c18.421,38.025,40.081,58.286,66.181,61.934c6.925,1.038,13.924,1.564,20.801,1.564
			c23.427,0,44.63-5.996,61.318-17.34c1.382-0.939,1.921-2.714,1.296-4.262c-0.626-1.549-2.25-2.454-3.892-2.168
			c-3.735,0.643-7.624,1.392-11.384,2.117c-11.826,2.28-24.054,4.637-35.788,4.637c-13.522,0-24.466-3.253-33.459-9.947
			c-0.067-0.049-0.136-0.098-0.207-0.143c-41.438-26.502-57.753-84.706-34.917-124.554c0.021-0.036,0.04-0.072,0.059-0.107
			c16.293-30.86,48.075-46.297,100.019-48.582c2.019-0.089,4.086-0.134,6.144-0.134c42.5,0,83.673,19.083,108.272,30.485
			c6.555,3.039,12.216,5.662,16.507,7.284c0.063,0.024,0.125,0.046,0.188,0.065c10.857,3.418,23.455,7.065,35.583,7.065
			c14.167,0,24.845-5.159,31.736-15.333c6.398-7.789,6.868-23.345,4.042-34.111c-1.631-6.216-4.131-9.991-7.43-11.22
			c-1.146-0.428-2.438-0.232-3.408,0.517c-0.971,0.75-1.484,1.949-1.359,3.169c0.98,9.555-2.378,20.151-8.554,26.992
			c-2.944,3.262-7.931,7.151-14.963,7.151c-1.936,0-3.949-0.297-5.986-0.882c-0.055-0.016-0.108-0.03-0.164-0.043
			c-11.757-2.776-23.143-7.808-34.153-12.673c-3.93-1.737-7.992-3.532-12.033-5.209c-39.477-20.346-75.723-30.235-110.804-30.235
			c-13.689,0-27.331,1.563-40.545,4.646c-26.77,4.966-62.623,20.211-83.126,48.134c-12.338,14.776-19.622,33.466-21.061,54.058
			c-0.922,13.185,0.653,26.9,4.49,39.931c-1.097-0.318-2.318-0.109-3.251,0.666c-3.512,2.917-7.021,5.736-10.414,8.463
			c-15.736,12.644-30.6,24.585-44.985,45.207c-0.029,0.042-0.058,0.085-0.086,0.128c-24.555,38.702-51.495,89.988-41.792,143.432
			c9.113,57.077,64.117,93.497,113.79,99.979c23.787,2.771,48.59,4.117,75.829,4.118c0.003,0,0.005,0,0.008,0
			c24.273,0,50.286-1.059,81.858-3.33c0.832-0.061,1.615-0.41,2.213-0.988c0.873-0.846,1.4-1.686,1.708-2.468
			c0.285,1.273,0.674,2.313,1.2,3.101c0.462,0.691,1.152,1.199,1.95,1.434c0.57,0.168,1.158,0.253,1.747,0.253c0,0,0.001,0,0.002,0
			c2.542,0,4.901-1.519,7.012-4.515c0.277-0.393,0.551-0.822,0.822-1.27c0.156,1.134,0.812,2.843,3.246,3.963
			c0.466,0.215,0.973,0.326,1.483,0.326c0.015,0,0.027,0,0.041,0c51.76-0.586,89.242-12.746,105.544-34.241
			c8.55-11.273,11.033-24.827,7.184-39.193c-3.232-12.063-10.028-27.675-17.896-45.752c-15.582-35.796-34.973-80.346-34.975-117.87
			c0.92-32.678,30.495-47.068,59.098-60.984c6.955-3.384,13.527-6.583,19.614-10.018c19.832-8.921,37.108-22.649,48.663-38.67
			C544.48,292.05,549.285,271.393,544.89,251.007z"/>
		</svg>'; break;
    case 'comment' : echo '<svg version="1.1" id="comment_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 width="511.625px" height="511.627px" viewBox="0 0 511.625 511.627" enable-background="new 0 0 511.625 511.627"
		 xml:space="preserve">
		<path d="M477.757,125.582c-23.014-28.287-54.588-50.892-93.849-67.187c-38.959-16.171-82.058-24.371-128.096-24.371
			c-46.037,0-89.134,8.2-128.096,24.371c-39.262,16.295-70.837,38.9-93.85,67.187C10.457,154.355-1.414,186.25-1.414,220.38
			c0,29.462,8.977,57.393,26.68,83.017c16.185,23.426,38.103,43.574,65.221,59.97c-1.455,4.571-3.07,8.996-4.826,13.216
			c-2.657,6.374-5.059,11.629-7.136,15.611c-2.009,3.845-4.79,8.196-8.272,12.944c-4.449,6.082-6.778,8.888-7.952,10.174
			c-1.939,2.127-5.13,5.636-9.573,10.541c-4.008,4.427-6.785,7.517-8.269,9.2c-0.852,0.807-1.702,1.826-2.805,3.173
			c-1.267,1.536-1.907,2.308-1.915,2.316l-2.222,3.243c-0.949,1.412-2.716,4.044-2.816,7.352c-0.033,0.113-0.074,0.251-0.126,0.416
			c-1.184,3.784-0.752,6.764,0.069,8.889c1.222,4.835,3.649,8.867,7.228,11.997c3.874,3.378,8.547,5.164,13.515,5.164h1.95l0.56-0.07
			c12.387-1.526,23.433-3.659,32.836-6.337c48.166-12.336,91.199-34.639,127.976-66.319c12.693,1.234,25.154,1.857,37.102,1.857
			c46.045,0,89.144-8.2,128.096-24.374c39.268-16.301,70.843-38.903,93.848-67.181c23.413-28.771,35.284-60.667,35.284-94.8
			C513.04,186.249,501.168,154.354,477.757,125.582z M144.257,370.908l9.392-33.4l-30.32-17.418
			c-22.697-12.928-40.467-28.369-52.816-45.897c-12.02-17.06-18.114-35.164-18.114-53.809c0-23.174,8.707-44.271,26.616-64.496
			c18.23-20.579,43.309-37.213,74.54-49.44c31.542-12.351,65.947-18.613,102.258-18.613c36.313,0,70.716,6.261,102.251,18.609
			c31.234,12.231,56.314,28.865,74.541,49.438c17.91,20.225,26.617,41.322,26.617,64.497c0,23.177-8.706,44.277-26.612,64.499
			c-18.235,20.578-43.313,37.212-74.543,49.439c-31.542,12.346-65.947,18.605-102.26,18.605c-10.872,0-22.623-0.725-35.025-2.165
			l-19.797-2.079l-14.91,13.179c-15.432,13.553-32.331,25.219-50.451,34.848C139.044,388.331,141.931,379.712,144.257,370.908z"/>
		</svg>'; break;
	case 'email' : echo '<svg version="1.1" id="email_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 viewBox="0 0 382.117 382.117" style="enable-background:new 0 0 382.117 382.117;" xml:space="preserve">
		<path d="M336.764,45.945H45.354C20.346,45.945,0,65.484,0,89.5v203.117c0,24.016,20.346,43.555,45.354,43.555h291.41
			c25.008,0,45.353-19.539,45.353-43.555V89.5C382.117,65.484,361.772,45.945,336.764,45.945z M336.764,297.72H45.354
			c-3.676,0-6.9-2.384-6.9-5.103V116.359l131.797,111.27c2.702,2.282,6.138,3.538,9.676,3.538l22.259,0.001
			c3.536,0,6.974-1.257,9.677-3.539l131.803-111.274v176.264C343.664,295.336,340.439,297.72,336.764,297.72z M191.059,192.987
			L62.87,84.397h256.378L191.059,192.987z"/>
		</svg>'; break;
    case "pdf" : echo '<svg version="1.1" id="pdf_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 width="550.801px" height="550.801px" viewBox="0 0 550.801 550.801" style="enable-background:new 0 0 550.801 550.801;"
		 xml:space="preserve">
		<path d="M160.381,282.225c0-14.832-10.299-23.684-28.474-23.684c-7.414,0-12.437,0.715-15.071,1.432V307.6
			c3.114,0.707,6.942,0.949,12.192,0.949C148.419,308.549,160.381,298.74,160.381,282.225z"/>
		<path d="M272.875,259.019c-8.145,0-13.397,0.717-16.519,1.435v105.523c3.116,0.729,8.142,0.729,12.69,0.729
			c33.017,0.231,54.554-17.946,54.554-56.474C323.842,276.719,304.215,259.019,272.875,259.019z"/>
		<path d="M488.426,197.019H475.2v-63.816c0-0.398-0.063-0.799-0.116-1.202c-0.021-2.534-0.827-5.023-2.562-6.995L366.325,3.694
			c-0.032-0.031-0.063-0.042-0.085-0.076c-0.633-0.707-1.371-1.295-2.151-1.804c-0.231-0.155-0.464-0.285-0.706-0.419
			c-0.676-0.369-1.393-0.675-2.131-0.896c-0.2-0.056-0.38-0.138-0.58-0.19C359.87,0.119,359.037,0,358.193,0H97.2
			c-11.918,0-21.6,9.693-21.6,21.601v175.413H62.377c-17.049,0-30.873,13.818-30.873,30.873v160.545
			c0,17.043,13.824,30.87,30.873,30.87h13.224V529.2c0,11.907,9.682,21.601,21.6,21.601h356.4c11.907,0,21.6-9.693,21.6-21.601
			V419.302h13.226c17.044,0,30.871-13.827,30.871-30.87v-160.54C519.297,210.838,505.47,197.019,488.426,197.019z M97.2,21.605
			h250.193v110.513c0,5.967,4.841,10.8,10.8,10.8h95.407v54.108H97.2V21.605z M362.359,309.023c0,30.876-11.243,52.165-26.82,65.333
			c-16.971,14.117-42.82,20.814-74.396,20.814c-18.9,0-32.297-1.197-41.401-2.389V234.365c13.399-2.149,30.878-3.346,49.304-3.346
			c30.612,0,50.478,5.508,66.039,17.226C351.828,260.69,362.359,280.547,362.359,309.023z M80.7,393.499V234.365
			c11.241-1.904,27.042-3.346,49.296-3.346c22.491,0,38.527,4.308,49.291,12.928c10.292,8.131,17.215,21.534,17.215,37.328
			c0,15.799-5.25,29.198-14.829,38.285c-12.442,11.728-30.865,16.996-52.407,16.996c-4.778,0-9.1-0.243-12.435-0.723v57.67H80.7
			V393.499z M453.601,523.353H97.2V419.302h356.4V523.353z M484.898,262.127h-61.989v36.851h57.913v29.674h-57.913v64.848h-36.593
			V232.216h98.582V262.127z"/>
		</svg>'; break;
	case 'whatsapp' : echo '<svg version="1.1" id="whatsapp_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 width="90px" height="90px" viewBox="0 0 90 90" style="enable-background:new 0 0 90 90;" xml:space="preserve">
		<path class="WhatsApp" d="M90,43.841c0,24.213-19.779,43.841-44.182,43.841c-7.747,0-15.025-1.98-21.357-5.455L0,90l7.975-23.522
			c-4.023-6.606-6.34-14.354-6.34-22.637C1.635,19.628,21.416,0,45.818,0C70.223,0,90,19.628,90,43.841z M45.818,6.982
			c-20.484,0-37.146,16.535-37.146,36.859c0,8.065,2.629,15.534,7.076,21.61L11.107,79.14l14.275-4.537
			c5.865,3.851,12.891,6.097,20.437,6.097c20.481,0,37.146-16.533,37.146-36.857S66.301,6.982,45.818,6.982z M68.129,53.938
			c-0.273-0.447-0.994-0.717-2.076-1.254c-1.084-0.537-6.41-3.138-7.4-3.495c-0.993-0.358-1.717-0.538-2.438,0.537
			c-0.721,1.076-2.797,3.495-3.43,4.212c-0.632,0.719-1.263,0.809-2.347,0.271c-1.082-0.537-4.571-1.673-8.708-5.333
			c-3.219-2.848-5.393-6.364-6.025-7.441c-0.631-1.075-0.066-1.656,0.475-2.191c0.488-0.482,1.084-1.255,1.625-1.882
			c0.543-0.628,0.723-1.075,1.082-1.793c0.363-0.717,0.182-1.344-0.09-1.883c-0.27-0.537-2.438-5.825-3.34-7.977
			c-0.902-2.15-1.803-1.792-2.436-1.792c-0.631,0-1.354-0.09-2.076-0.09c-0.722,0-1.896,0.269-2.889,1.344
			c-0.992,1.076-3.789,3.676-3.789,8.963c0,5.288,3.879,10.397,4.422,11.113c0.541,0.716,7.49,11.92,18.5,16.223
			C58.2,65.771,58.2,64.336,60.186,64.156c1.984-0.179,6.406-2.599,7.312-5.107C68.398,56.537,68.398,54.386,68.129,53.938z"/>
		</svg>'; break;
    case 'search' : echo '<svg version="1.1" id="search_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 viewBox="0 0 250.313 250.313" style="enable-background:new 0 0 250.313 250.313;" xml:space="preserve">
		<path d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76
			c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911
			c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38
			c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146
			c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236
			C170.146,140.044,140.043,170.146,102.911,170.146z"/>
		</svg>'; break;
		case 'refresh' : echo '<svg version="1.1" class="svgrefresh" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="487.23px" height="487.23px" viewBox="0 0 487.23 487.23" style="enable-background:new 0 0 487.23 487.23;"
			 xml:space="preserve">
				<g>
					<path d="M55.323,203.641c15.664,0,29.813-9.405,35.872-23.854c25.017-59.604,83.842-101.61,152.42-101.61
						c37.797,0,72.449,12.955,100.23,34.442l-21.775,3.371c-7.438,1.153-13.224,7.054-14.232,14.512
						c-1.01,7.454,3.008,14.686,9.867,17.768l119.746,53.872c5.249,2.357,11.33,1.904,16.168-1.205
						c4.83-3.114,7.764-8.458,7.796-14.208l0.621-131.943c0.042-7.506-4.851-14.144-12.024-16.332
						c-7.185-2.188-14.947,0.589-19.104,6.837l-16.505,24.805C370.398,26.778,310.1,0,243.615,0C142.806,0,56.133,61.562,19.167,149.06
						c-5.134,12.128-3.84,26.015,3.429,36.987C29.865,197.023,42.152,203.641,55.323,203.641z"/>
					<path d="M464.635,301.184c-7.27-10.977-19.558-17.594-32.728-17.594c-15.664,0-29.813,9.405-35.872,23.854
						c-25.018,59.604-83.843,101.61-152.42,101.61c-37.798,0-72.45-12.955-100.232-34.442l21.776-3.369
						c7.437-1.153,13.223-7.055,14.233-14.514c1.009-7.453-3.008-14.686-9.867-17.768L49.779,285.089
						c-5.25-2.356-11.33-1.905-16.169,1.205c-4.829,3.114-7.764,8.458-7.795,14.207l-0.622,131.943
						c-0.042,7.506,4.85,14.144,12.024,16.332c7.185,2.188,14.948-0.59,19.104-6.839l16.505-24.805
						c44.004,43.32,104.303,70.098,170.788,70.098c100.811,0,187.481-61.561,224.446-149.059
						C473.197,326.043,471.903,312.157,464.635,301.184z"/>
				</g>
			</svg>'; break;
		case 'eye' : echo '<svg version="1.1" class="eye_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
							<g class="eye">
									<path d="M16,4C7.164,4,0,15.844,0,15.844S7.164,28,16,28s16-12.156,16-12.156S24.836,4,16,4z M16,24
										c-4.418,0-8-3.582-8-8s3.582-8,8-8s8,3.582,8,8S20.418,24,16,24z"/>
									<circle cx="16" cy="16.016" r="4"/>
							</g>
						</svg>'; break;
		case 'download' : echo '<svg version="1.1" id="download_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						width="346.223px" height="346.223px" viewBox="0 0 346.223 346.223" style="enable-background:new 0 0 346.223 346.223;"
						xml:space="preserve">
						<g>
							<g>
								<path d="M332.762,0.004H13.461C6.027,0.004,0,6.031,0,13.465V332.76c0,7.434,6.027,13.459,13.461,13.459h319.301
									c7.434,0,13.461-6.025,13.461-13.459V13.465C346.223,6.031,340.195,0.004,332.762,0.004z M319.301,319.299H26.922V26.925h292.379
									V319.299L319.301,319.299z"/>
								<path d="M163.59,237.457c2.524,2.523,5.948,3.943,9.517,3.943c3.569,0,6.995-1.42,9.516-3.943l51.488-51.489
									c5.258-5.258,5.258-13.777,0-19.035c-5.258-5.258-13.783-5.258-19.035,0l-28.508,28.513V82.871c0-7.434-6.027-13.461-13.46-13.461
									c-7.434,0-13.46,6.027-13.46,13.461v112.575l-28.512-28.513c-5.251-5.258-13.782-5.258-19.034,0
									c-5.258,5.258-5.258,13.777,0,19.035L163.59,237.457z"/>
								<path d="M66.396,290.998h213.43c7.434,0,13.461-6.027,13.461-13.461s-6.027-13.461-13.461-13.461H66.396
									c-7.434,0-13.46,6.027-13.46,13.461S58.963,290.998,66.396,290.998z"/>
							</g>
						</g>
						</svg>'; break;
		case 'check' : echo '<svg version="1.1" id="check_icon" class="'.$class.'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="415.582px" height="415.582px" viewBox="0 0 415.582 415.582" style="enable-background:new 0 0 415.582 415.582;"
					 xml:space="preserve">
					<path d="M411.47,96.426l-46.319-46.32c-5.482-5.482-14.371-5.482-19.853,0L152.348,243.058l-82.066-82.064
						c-5.48-5.482-14.37-5.482-19.851,0l-46.319,46.32c-5.482,5.481-5.482,14.37,0,19.852l138.311,138.31
						c2.741,2.742,6.334,4.112,9.926,4.112c3.593,0,7.186-1.37,9.926-4.112L411.47,116.277c2.633-2.632,4.111-6.203,4.111-9.925
						C415.582,102.628,414.103,99.059,411.47,96.426z"/>

				</svg>'; break;

	}
}
?>