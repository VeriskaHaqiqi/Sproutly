// ── Data artikel (konten beda-beda per artikel) ───────────
const articles = {
  "irrigation": {
    hero: "https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=1600&q=80",
    author: "John Parker",
    avatar: "https://randomuser.me/api/portraits/men/32.jpg",
    date: "March 15, 2024",
    readTime: "6 min read",
    lead: "Water scarcity is one of the most pressing challenges in modern agriculture. As global demand for food increases, farmers must find smarter ways to use water — and modern irrigation technology is leading the charge.",
    title: "Modern Irrigation Techniques for Water Conservation",
    p1: "Drip irrigation delivers water directly to the root zone of plants, dramatically reducing evaporation and runoff. Unlike traditional flood irrigation, drip systems can cut water usage by up to 50% while maintaining or even improving crop yields.",
    p2: "Smart irrigation controllers use weather data, soil sensors, and crop evapotranspiration models to automatically adjust watering schedules. These systems ensure crops receive exactly the right amount of water at the right time.",
    quote: "Every drop saved in the field today is water secured for the next generation of farmers. Efficient irrigation is not just good practice — it's our responsibility.",
    quoteAuthor: "- John Parker, Agricultural Water Specialist",
    subtitle1: "Drip vs. Sprinkler Systems",
    p3: "Drip irrigation excels in row crops, orchards, and vineyards where precision matters. Sprinkler systems, on the other hand, are better suited for field crops and pastures where uniform coverage over large areas is needed.",
    inlineImage: "https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1200&q=80",
    imageCaption: "Drip irrigation lines deliver water precisely to the root zone, minimizing waste",
    p4: "Subsurface drip irrigation (SDI) takes efficiency even further by burying drip lines below the soil surface. This eliminates surface evaporation entirely and keeps foliage dry, reducing fungal disease risk.",
    subtitle2: "Sensor-Based Automation",
    p5: "Soil moisture sensors placed at various root depths give farmers real-time data on water availability. When combined with automated irrigation controllers, these sensors can trigger watering cycles only when genuinely needed.",
    p6: "Flow meters and pressure gauges help detect leaks and blockages in irrigation systems early, preventing water loss and crop stress before problems escalate.",
    subtitle3: "Rainwater Harvesting Integration",
    p7: "Capturing and storing rainwater in farm ponds or tanks supplements irrigation supplies during dry spells. Integrating harvested rainwater with drip systems creates a closed-loop water management approach.",
    p8: "With the right combination of technology, planning, and monitoring, modern irrigation can transform water-stressed farms into productive, resilient operations that thrive even in drought conditions.",
  },
  "soil": {
    hero: "https://images.unsplash.com/photo-1461354464878-ad92f492a5a0?auto=format&fit=crop&w=1600&q=80",
    author: "Sarah Mitchell",
    avatar: "https://randomuser.me/api/portraits/women/44.jpg",
    date: "March 14, 2024",
    readTime: "7 min read",
    lead: "Healthy soil is the foundation of productive agriculture. Yet decades of intensive farming have degraded soil quality worldwide. Composting offers a natural, cost-effective way to restore and maintain soil health for generations to come.",
    title: "Building Healthy Soil Through Composting",
    p1: "Compost is decomposed organic matter — kitchen scraps, crop residues, manure, and yard waste — transformed by microorganisms into a rich, dark material that improves soil structure, water retention, and nutrient availability.",
    p2: "Adding compost to sandy soils helps them retain moisture and nutrients. In clay soils, compost improves drainage and aeration. Either way, the result is a more hospitable environment for plant roots and soil organisms.",
    quote: "Composting is the art of turning waste into wealth. Every vegetable peel, every crop stem, every fallen leaf is a gift back to the soil that fed us.",
    quoteAuthor: "- Sarah Mitchell, Soil Health Consultant",
    subtitle1: "Hot vs. Cold Composting",
    p3: "Hot composting involves actively managing a pile to maintain temperatures between 55–65°C, which accelerates decomposition and kills weed seeds and pathogens. Cold composting is slower but requires far less effort — simply pile materials and wait.",
    inlineImage: "https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1200&q=80",
    imageCaption: "Finished compost has a dark, crumbly texture and earthy smell — a sign of rich biological activity",
    p4: "The ideal compost pile balances 'browns' (carbon-rich materials like straw, cardboard, and dry leaves) with 'greens' (nitrogen-rich materials like food scraps, grass clippings, and fresh manure) in roughly a 3:1 ratio by volume.",
    subtitle2: "Vermicomposting",
    p5: "Vermicomposting uses worms — typically red wigglers — to process organic waste into castings, a form of compost that is even richer in plant-available nutrients than conventional compost. Worm castings also contain beneficial microbes that suppress plant diseases.",
    p6: "A small vermicomposting bin can process a household's kitchen scraps year-round, producing high-quality amendments for garden beds and potted plants with minimal space and effort.",
    subtitle3: "Applying Compost Effectively",
    p7: "Compost works best when incorporated into the top 15–20 cm of soil before planting. For established crops, topdressing with 2–5 cm of compost and letting rain work it in is equally effective.",
    p8: "With consistent composting, farmers can reduce their dependence on synthetic fertilizers, cut input costs, and build soil organic matter year after year — creating a self-reinforcing cycle of soil health and productivity.",
  },
  "pest": {
    hero: "https://images.unsplash.com/photo-1471193945509-9ad0617afabf?auto=format&fit=crop&w=1600&q=80",
    author: "Michael Chen",
    avatar: "https://randomuser.me/api/portraits/men/22.jpg",
    date: "March 13, 2024",
    readTime: "8 min read",
    lead: "Chemical pesticides have long been the default response to farm pests. But growing concerns about environmental impact, human health, and pesticide resistance are driving a shift toward organic pest management strategies that work with nature rather than against it.",
    title: "Organic Pest Management Strategies",
    p1: "Integrated Pest Management (IPM) is a holistic approach that combines biological, cultural, physical, and chemical tools to minimize pest damage in an economically and environmentally sound way. Organic IPM eliminates synthetic chemicals entirely.",
    p2: "The first step in organic pest management is accurate identification. Many insects that look like pests are actually beneficial predators. Misidentification leads to unnecessary interventions that can disrupt natural pest control.",
    quote: "Nature has its own pest control system — billions of predatory insects, fungi, and bacteria working to keep pest populations in check. Our job is to support that system, not undermine it.",
    quoteAuthor: "- Michael Chen, Integrated Pest Management Specialist",
    subtitle1: "Biological Control Agents",
    p3: "Ladybugs, lacewings, parasitic wasps, and ground beetles are powerful natural predators of common crop pests. Creating habitat for these beneficial insects — through hedgerows, flower strips, and reduced tillage — encourages them to take up residence in farm fields.",
    inlineImage: "https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1200&q=80",
    imageCaption: "Beneficial insect habitat strips alongside crop fields support natural pest predators",
    p4: "Microbial pesticides derived from naturally occurring organisms like Bacillus thuringiensis (Bt) or Beauveria bassiana are approved for organic use. These products are highly selective, targeting specific pests while leaving beneficial insects unharmed.",
    subtitle2: "Cultural and Physical Controls",
    p5: "Crop rotation disrupts pest life cycles by removing their preferred host plants from a field each season. Row covers, sticky traps, pheromone lures, and physical barriers like copper tape for slugs provide non-chemical pest suppression.",
    p6: "Timing plantings to avoid peak pest pressure, choosing pest-resistant varieties, and maintaining optimal plant health through proper nutrition and irrigation all reduce vulnerability to pest attack.",
    subtitle3: "Monitoring and Thresholds",
    p7: "Regular scouting — walking fields to count and identify pests and beneficial organisms — is the cornerstone of any IPM program. Economic thresholds help farmers decide when pest populations are high enough to warrant intervention.",
    p8: "By combining observation, prevention, and targeted biological controls, organic pest management can protect crops effectively while preserving the biodiversity and ecological balance that make farms resilient in the long term.",
  },
  "drone": {
    hero: "https://images.unsplash.com/photo-1473448912268-2022ce9509d8?auto=format&fit=crop&w=1600&q=80",
    author: "David Rodriguez",
    avatar: "https://randomuser.me/api/portraits/men/45.jpg",
    date: "March 12, 2024",
    readTime: "7 min read",
    lead: "Agricultural drones have moved from novelty to necessity in just a few years. From crop scouting to precision spraying, unmanned aerial vehicles are giving farmers a bird's-eye view of their fields — and transforming how decisions get made.",
    title: "Using Drones for Precision Agriculture",
    p1: "Modern agricultural drones carry multispectral cameras that capture data beyond the visible spectrum. NDVI (Normalized Difference Vegetation Index) maps generated from this data reveal crop stress, nutrient deficiencies, and irrigation problems invisible to the naked eye.",
    p2: "A single drone flight can survey hundreds of hectares in minutes, providing data that would take field workers days to collect on foot. Early detection of problems means earlier intervention — and significantly less crop loss.",
    quote: "Drones don't replace the farmer's intuition — they sharpen it. Seeing your entire farm in one image changes how you think about every decision you make.",
    quoteAuthor: "- David Rodriguez, Precision Agriculture Technology Specialist",
    subtitle1: "Precision Spraying",
    p3: "Drone sprayers equipped with GPS guidance and variable-rate technology can apply pesticides, fungicides, or fertilizers only where needed — reducing chemical use by 30–50% compared to blanket applications. They can also access difficult terrain and steep slopes safely.",
    inlineImage: "https://images.unsplash.com/photo-1473448912268-2022ce9509d8?auto=format&fit=crop&w=1200&q=80",
    imageCaption: "Agricultural drones map entire fields in minutes using multispectral imaging technology",
    p4: "Boom sprayer drones fly low and slow, using downwash from their rotors to improve spray penetration into dense crop canopies. This improves efficacy compared to conventional ground sprayers in some crops.",
    subtitle2: "Plant Counting and Stand Assessment",
    p5: "High-resolution drone imagery taken shortly after emergence allows automatic plant counting using AI image analysis. Accurate stand counts help farmers decide early whether replanting is needed, saving time and seed costs.",
    p6: "Drone-based 3D mapping creates digital elevation models of fields, helping identify low spots prone to waterlogging or compaction — issues that consistently reduce yields in affected areas.",
    subtitle3: "Integration with Farm Management Systems",
    p7: "Drone data is most valuable when integrated with farm management software and agronomic databases. Prescription maps generated from drone imagery can be uploaded directly to variable-rate spreaders and planters.",
    p8: "As drone technology continues to advance and costs fall, precision aerial monitoring is becoming accessible to farms of all sizes — bringing data-driven decision-making to agriculture at every scale.",
  },
  "rotation": {
    hero: "https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1600&q=80",
    author: "Emma Thompson",
    avatar: "https://randomuser.me/api/portraits/women/68.jpg",
    date: "March 11, 2024",
    readTime: "6 min read",
    lead: "Planting the same crop in the same field year after year is a recipe for trouble — declining yields, pest buildup, and soil exhaustion. Crop rotation is agriculture's oldest tool for maintaining productivity, and modern research continues to validate its power.",
    title: "Crop Rotation for Long-Term Sustainability",
    p1: "Crop rotation involves planting different crops sequentially in the same field across seasons or years. By alternating plant families, farmers interrupt pest and disease cycles, improve soil structure, and balance nutrient demands.",
    p2: "Legumes like soybeans, clover, and peas fix atmospheric nitrogen into the soil through symbiotic relationships with bacteria in their root nodules. Including legumes in a rotation can significantly reduce the need for synthetic nitrogen fertilizers.",
    quote: "Rotation is the rhythm of sustainable farming. Each crop leaves the soil a little different from how it found it — and the smart farmer designs that sequence with intention.",
    quoteAuthor: "- Emma Thompson, Sustainable Agriculture Researcher",
    subtitle1: "Designing a Rotation",
    p3: "A simple three-year rotation might cycle through a cereal crop (like corn or wheat), a legume (like soybean or clover), and a root or brassica crop (like turnips or canola). Each crop group has different nutrient needs, root architecture, and pest associations.",
    inlineImage: "https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1200&q=80",
    imageCaption: "Diverse rotations support soil health and break cycles of pest and disease buildup",
    p4: "Cover crops can be incorporated between main cash crops to protect bare soil, add organic matter, and suppress weeds. Winter rye, hairy vetch, and mustard are popular cover crop choices with different functional benefits.",
    subtitle2: "Pest and Disease Management",
    p5: "Many soil-borne pathogens and crop-specific pests survive in the soil primarily when their preferred host plant is present. Rotating to a non-host crop starves these organisms and naturally reduces their populations.",
    p6: "Weed pressure also decreases with well-designed rotations, especially when crops with different growth habits, planting dates, and competitive abilities are alternated. Some rotations allow for different herbicide programs that control weeds resistant to a single chemistry.",
    subtitle3: "Economic Considerations",
    p7: "While diversified rotations require more planning and management, they typically reduce input costs through lower fertilizer and pesticide requirements. They also spread market risk across multiple commodities.",
    p8: "Long-term trials consistently show that well-managed rotations outperform continuous monocultures in total system profitability when all input costs, yield stability, and soil health benefits are accounted for over multiple years.",
  },
  "climate": {
    hero: "https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1600&q=80",
    author: "James Wilson",
    avatar: "https://randomuser.me/api/portraits/men/11.jpg",
    date: "March 10, 2024",
    readTime: "9 min read",
    lead: "Climate change is no longer a distant threat for farmers — it's happening now, reshaping rainfall patterns, extending droughts, intensifying storms, and shifting growing seasons. Adapting farming systems to these new realities is both urgent and achievable.",
    title: "Climate-Smart Farming Practices",
    p1: "Climate-smart agriculture (CSA) is an approach that helps farmers adapt to climate variability while reducing agriculture's contribution to greenhouse gas emissions. It focuses on three goals: sustainably increasing productivity, adapting to climate change, and reducing emissions.",
    p2: "Conservation tillage and no-till farming reduce soil disturbance, keeping carbon locked in the ground and reducing fuel consumption. Globally, no-till adoption on cropland could sequester hundreds of millions of tonnes of CO₂ annually.",
    quote: "The farms that will thrive in the next 50 years are being designed today. Climate-smart practices are not a cost — they are an investment in agricultural resilience.",
    quoteAuthor: "- James Wilson, Climate-Smart Agriculture Advisor",
    subtitle1: "Agroforestry",
    p3: "Integrating trees with crops and livestock creates more diverse and resilient farming systems. Trees provide shade, windbreaks, and habitat for beneficial organisms while sequestering carbon in wood and roots. Agroforestry systems can produce food, timber, and income simultaneously.",
    inlineImage: "https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=1200&q=80",
    imageCaption: "Agroforestry systems integrate trees with crops, building resilience and sequestering carbon",
    p4: "Silvopasture — combining trees with pasture and livestock — improves animal welfare through shade and shelter while diversifying farm income and building long-term soil carbon stocks.",
    subtitle2: "Water Management for Climate Resilience",
    p5: "As rainfall becomes less predictable, on-farm water storage becomes more critical. Farm dams, contour banks, and constructed wetlands capture rainfall when it comes and release it slowly, buffering farms against both flood and drought.",
    p6: "Mulching and cover cropping protect soil moisture between rains, reducing the frequency and duration of irrigation needed during dry spells.",
    subtitle3: "Diversification as a Risk Strategy",
    p7: "Growing multiple crops and maintaining diverse livestock enterprises reduces the risk that any single climate event — a frost, a flood, a drought — will devastate an entire farm's income. Crop insurance and forward contracts also help manage financial risk.",
    p8: "Climate-smart farming requires ongoing learning and adaptation. Connecting with agricultural extension services, peer networks, and research institutions helps farmers access the latest climate projections and management options relevant to their region.",
  },
  "hydroponic": {
    hero: "https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?auto=format&fit=crop&w=1600&q=80",
    author: "Lisa Anderson",
    avatar: "https://randomuser.me/api/portraits/women/21.jpg",
    date: "March 9, 2024",
    readTime: "7 min read",
    lead: "Growing plants without soil might sound futuristic, but hydroponics has been practiced for decades — and it's now one of the fastest-growing segments of agriculture globally. Offering precise control over nutrients, water, and environment, hydroponic systems produce more food in less space with dramatically less water.",
    title: "Introduction to Hydroponic Farming",
    p1: "In hydroponic systems, plants grow with their roots in a nutrient-rich water solution rather than soil. The roots receive oxygen, water, and all essential mineral nutrients directly, allowing plants to focus energy on above-ground growth rather than extensive root development.",
    p2: "The result is faster growth, higher yields per square metre, and year-round production regardless of outdoor weather. Hydroponic systems can be set up anywhere from warehouses and rooftops to shipping containers and vertical farms.",
    quote: "Hydroponics proves that soil is not magic — nutrients and water are. When we deliver those precisely, plants respond by producing more than anyone thought possible.",
    quoteAuthor: "- Lisa Anderson, Controlled Environment Agriculture Specialist",
    subtitle1: "Common Hydroponic Systems",
    p3: "Nutrient Film Technique (NFT) flows a shallow stream of nutrient solution continuously over bare roots in sloped channels. Deep Water Culture (DWC) suspends plant roots directly in an oxygenated nutrient reservoir. Both systems are popular for leafy greens and herbs.",
    inlineImage: "https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?auto=format&fit=crop&w=1200&q=80",
    imageCaption: "Hydroponic lettuce grows rapidly under LED lighting in a controlled environment facility",
    p4: "Kratky hydroponics is a passive system requiring no pumps or electricity — plants are suspended above a sealed reservoir that gradually empties as roots absorb the solution, drawing in air as the water level drops. Ideal for beginners and low-resource settings.",
    subtitle2: "Nutrient Management",
    p5: "Hydroponic nutrient solutions must supply all 17 essential plant nutrients in balanced proportions. pH management is critical — most crops perform best between pH 5.5 and 6.5, where nutrient availability is optimal.",
    p6: "Electrical conductivity (EC) is used to measure nutrient solution strength. Regular monitoring and adjustment of both pH and EC ensures plants always have access to the nutrients they need at the right concentrations.",
    subtitle3: "Water Efficiency",
    p7: "Closed-loop hydroponic systems recirculate nutrient solution, using up to 90% less water than conventional soil-based growing. This makes hydroponics especially valuable in water-scarce regions and urban environments where traditional agriculture is impractical.",
    p8: "As LED lighting costs fall and system designs improve, hydroponic and vertical farming are becoming economically viable for an expanding range of crops — moving beyond salad greens to tomatoes, peppers, strawberries, and beyond.",
  },
  "nutrients": {
    hero: "https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80",
    author: "Robert Martinez",
    avatar: "https://randomuser.me/api/portraits/men/51.jpg",
    date: "March 8, 2024",
    readTime: "8 min read",
    lead: "Soil nutrients are the building blocks of plant health and agricultural productivity. Understanding what nutrients your soil contains, what crops need, and how to supply deficiencies effectively is fundamental to sustainable, profitable farming.",
    title: "Understanding Soil Nutrients and Fertilization",
    p1: "Plants require 17 essential nutrients for healthy growth. Carbon, hydrogen, and oxygen come from air and water. The remaining 14 — including nitrogen, phosphorus, potassium, calcium, magnesium, and sulfur, plus eight trace elements — must come from the soil or be applied as fertilizer.",
    p2: "Soil testing is the essential first step in any fertilization program. A comprehensive soil test measures pH, organic matter, and available levels of major and minor nutrients, allowing targeted fertilizer applications rather than guesswork.",
    quote: "Fertilizing without a soil test is like prescribing medicine without a diagnosis. The soil tells us what it needs — we simply have to learn to ask.",
    quoteAuthor: "- Robert Martinez, Soil Fertility Agronomist",
    subtitle1: "The Big Three: N, P, K",
    p3: "Nitrogen (N) drives vegetative growth and leaf greenness. Phosphorus (P) supports root development, flowering, and fruiting. Potassium (K) regulates water use, disease resistance, and overall plant vigor. Most commercial fertilizers are labeled with their N-P-K percentages.",
    inlineImage: "https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1200&q=80",
    imageCaption: "Soil sampling at multiple depths and locations provides accurate baseline data for fertilizer planning",
    p4: "Nitrogen management is particularly challenging because it is highly mobile in the soil and can be lost through leaching, runoff, or volatilization. Split applications, slow-release formulations, and inhibitor-treated fertilizers reduce nitrogen losses and improve efficiency.",
    subtitle2: "Secondary Nutrients and Micronutrients",
    p5: "Calcium strengthens cell walls and is critical for fruit quality. Magnesium is central to chlorophyll and is often deficient in sandy, acidic soils. Sulfur supports protein synthesis and is increasingly deficient as atmospheric sulfur deposition decreases.",
    p6: "Micronutrient deficiencies — particularly iron, zinc, boron, and manganese — are often most apparent at high soil pH, where these elements become chemically unavailable despite adequate total quantities in the soil.",
    subtitle3: "Organic vs. Synthetic Fertilizers",
    p7: "Organic fertilizers — manure, compost, bone meal, blood meal — release nutrients slowly as soil microbes break them down, feeding plants over weeks and months while improving soil biology. Synthetic fertilizers provide immediate, concentrated nutrition but require careful management to avoid waste and environmental harm.",
    p8: "The most effective fertilization programs integrate both organic matter management and targeted mineral applications, continuously calibrated by soil testing and crop performance monitoring to build long-term soil fertility.",
  },
  "rainwater": {
    hero: "https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?auto=format&fit=crop&w=1600&q=80",
    author: "Olivia Green",
    avatar: "https://randomuser.me/api/portraits/women/54.jpg",
    date: "March 7, 2024",
    readTime: "6 min read",
    lead: "As groundwater tables drop and irrigation costs rise, capturing and storing rainwater on-farm is gaining renewed attention. Rainwater harvesting is an ancient practice being rediscovered and modernized — offering farmers a reliable, low-cost water source that reduces dependence on external supplies.",
    title: "Rainwater Harvesting for Farm Use",
    p1: "Rainwater harvesting involves collecting runoff from rooftops, roads, fields, or purpose-built catchments and storing it in tanks, ponds, or underground cisterns for later use in irrigation, livestock watering, or farm processing.",
    p2: "Even modest rainfall can yield significant volumes of water. A 100 m² rooftop receives roughly 100 litres for every 1 mm of rain. A farm shed or greenhouse roof can capture tens of thousands of litres in a single storm event.",
    quote: "Rain is the most democratic resource on earth — it falls on every farm. Harvesting it is simply the art of keeping what nature provides rather than letting it run away.",
    quoteAuthor: "- Olivia Green, Water Resource Management Consultant",
    subtitle1: "Catchment and Storage Systems",
    p3: "Rooftop catchment systems use gutters and downpipes to direct rainfall into above-ground tanks or underground cisterns. First-flush diverters remove the initial, most contaminated runoff before directing cleaner water into storage.",
    inlineImage: "https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?auto=format&fit=crop&w=1200&q=80",
    imageCaption: "Farm ponds collect and store surface runoff for use during dry periods between rainfall events",
    p4: "Farm ponds and dams capture surface runoff from paddocks and roads. Properly designed with spillways and lined or compacted bases, earthen dams can store millions of litres at relatively low cost per unit of storage capacity.",
    subtitle2: "Water Quality Considerations",
    p5: "Harvested rainwater is generally clean but can pick up contaminants from roof materials, animal waste, or airborne pollutants. Testing water quality before use on edible crops, particularly for microbial contamination, is recommended.",
    p6: "Basic filtration through sand filters and UV treatment can render harvested rainwater suitable for drip irrigation of vegetables and other high-value crops where water quality standards are important.",
    subtitle3: "Integration with Irrigation Systems",
    p7: "Harvested rainwater can be pumped directly into drip or sprinkler irrigation systems, often after passing through a simple filtration stage to remove sediment and debris that could block emitters.",
    p8: "Combining rainwater harvesting with careful demand management — efficient irrigation scheduling, drought-tolerant crop selection, and mulching to reduce evaporation — creates a whole-farm water strategy capable of maintaining production through extended dry periods.",
  },
};

// ── Get article key from URL param ────────────────────────
function getArticleKey() {
  const params = new URLSearchParams(window.location.search);
  return params.get("article") || "irrigation";
}

// ── Populate page with article data ───────────────────────
function loadArticle() {
  const key = getArticleKey();
  const data = articles[key] || articles["irrigation"];

  // Hero background
  const hero = document.getElementById("articleHero");
  if (hero) {
    hero.style.backgroundImage = `linear-gradient(rgba(18,43,27,0.30), rgba(18,43,27,0.42)), url('${data.hero}')`;
    hero.style.backgroundSize = "cover";
    hero.style.backgroundPosition = "center";
  }

  // Meta
  setText("authorAvatar", null, data.avatar, "author-avatar-img");
  const av = document.getElementById("authorAvatar");
  if (av) { av.src = data.avatar; av.alt = data.author; }

  setText("articleAuthor", data.author);
  setText("articleDate", data.date);
  setText("articleReadTime", data.readTime);

  // Body
  setText("articleLead", data.lead);
  setText("articleTitle", data.title);
  setText("paragraph1", data.p1);
  setText("paragraph2", data.p2);
  setText("articleQuote", data.quote);
  setText("articleQuoteAuthor", data.quoteAuthor);
  setText("subtitle1", data.subtitle1);
  setText("paragraph3", data.p3);
  const img = document.getElementById("articleInlineImage");
  if (img) { img.src = data.inlineImage; }
  setText("articleImageCaption", data.imageCaption);
  setText("paragraph4", data.p4);
  setText("subtitle2", data.subtitle2);
  setText("paragraph5", data.p5);
  setText("paragraph6", data.p6);
  setText("subtitle3", data.subtitle3);
  setText("paragraph7", data.p7);
  setText("paragraph8", data.p8);
}

function setText(id, text, src, cls) {
  const el = document.getElementById(id);
  if (!el) return;
  if (text !== undefined && text !== null) el.textContent = text;
}

// ── Bookmark — persisted in localStorage ─────────────────
function getBookmarkKey() {
  return "bookmark_" + getArticleKey();
}

function initBookmark() {
  const btn   = document.getElementById("bookmarkBtn");
  const label = btn?.querySelector("span");
  if (!btn) return;

  // Read saved state for THIS article key from localStorage
  const key   = getBookmarkKey();
  const saved = localStorage.getItem(key) === "true";

  // Apply saved state on load
  if (saved) {
    btn.classList.add("saved");
    if (label) label.textContent = "Saved";
  } else {
    btn.classList.remove("saved");
    if (label) label.textContent = "Save";
  }

  btn.addEventListener("click", () => {
    const isSaved = btn.classList.toggle("saved");
    localStorage.setItem(key, isSaved ? "true" : "false");
    if (label) label.textContent = isSaved ? "Saved" : "Save";
  });
}

// ── Sidebar toggle ────────────────────────────────────────
function initSidebar() {
  const sidebar     = document.getElementById("sidebar");
  const mainContent = document.getElementById("mainContent");
  const toggle      = document.getElementById("menuToggle");
  if (!sidebar || !mainContent || !toggle) return;

  function open() {
    if (window.innerWidth <= 768) { sidebar.classList.add("show"); sidebar.classList.remove("closed"); }
    else { sidebar.classList.remove("closed"); mainContent.classList.add("shifted"); mainContent.classList.remove("full"); }
  }
  function close() {
    sidebar.classList.add("closed"); sidebar.classList.remove("show");
    mainContent.classList.remove("shifted"); mainContent.classList.add("full");
  }
  function isOpen() { return window.innerWidth <= 768 ? sidebar.classList.contains("show") : !sidebar.classList.contains("closed"); }

  toggle.addEventListener("click", () => isOpen() ? close() : open());
  document.querySelectorAll(".menu-link").forEach(l => l.addEventListener("click", close));
  document.addEventListener("click", (e) => {
    if (window.innerWidth <= 768 && isOpen() && !sidebar.contains(e.target) && !toggle.contains(e.target)) close();
  });
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) sidebar.classList.remove("show");
    else { mainContent.classList.remove("shifted"); mainContent.classList.add("full"); }
  });
}

// ── Init ──────────────────────────────────────────────────
loadArticle();
initBookmark();
initSidebar();