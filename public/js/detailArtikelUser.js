document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const menuToggle = document.getElementById("menuToggle");
  const bookmarkBtn = document.getElementById("bookmarkBtn");

  const articleHero = document.getElementById("articleHero");
  const authorAvatar = document.getElementById("authorAvatar");
  const articleAuthor = document.getElementById("articleAuthor");
  const articleDate = document.getElementById("articleDate");
  const articleReadTime = document.getElementById("articleReadTime");
  const articleLead = document.getElementById("articleLead");
  const articleTitle = document.getElementById("articleTitle");
  const paragraph1 = document.getElementById("paragraph1");
  const paragraph2 = document.getElementById("paragraph2");
  const articleQuote = document.getElementById("articleQuote");
  const articleQuoteAuthor = document.getElementById("articleQuoteAuthor");
  const subtitle1 = document.getElementById("subtitle1");
  const paragraph3 = document.getElementById("paragraph3");
  const articleInlineImage = document.getElementById("articleInlineImage");
  const articleImageCaption = document.getElementById("articleImageCaption");
  const paragraph4 = document.getElementById("paragraph4");
  const subtitle2 = document.getElementById("subtitle2");
  const paragraph5 = document.getElementById("paragraph5");
  const paragraph6 = document.getElementById("paragraph6");
  const subtitle3 = document.getElementById("subtitle3");
  const paragraph7 = document.getElementById("paragraph7");
  const paragraph8 = document.getElementById("paragraph8");

  const recommendedCards = document.querySelectorAll(".recommended-card");

  const articles = {
    sustainable: {
      hero: "https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=1600&q=80",
      authorAvatar: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=80",
      inlineImage: "https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&w=1200&q=80",
      author: "Dr. Sarah Chen",
      date: "March 15, 2024",
      readTime: "8 min read",
      lead: "As the global population continues to grow and climate change presents new challenges, sustainable agriculture has become more critical than ever. Modern farmers are embracing innovative practices that not only increase productivity but also protect our environment for future generations.",
      title: "Understanding Sustainable Agriculture",
      p1: "Sustainable agriculture is a farming approach that focuses on producing food while maintaining the health of the environment, supporting economic viability, and promoting social equity. This holistic method considers the long-term impact of farming practices on soil health, water quality, biodiversity, and climate.",
      p2: "The core principles of sustainable agriculture include crop rotation, integrated pest management, conservation tillage, and the use of cover crops. These practices work together to create a farming system that is both productive and environmentally responsible.",
      quote: "Sustainable agriculture is not just about growing food — it’s about growing a future where farming works in harmony with nature, ensuring that we can feed the world while preserving our planet for generations to come.",
      quoteAuthor: "- Dr. Michael Rodriguez, Agricultural Sustainability Expert",
      s1: "Key Sustainable Practices",
      p3: "Several innovative practices are revolutionizing modern agriculture. Precision farming uses GPS technology and data analytics to optimize planting, fertilizing, and harvesting. This approach reduces waste, minimizes environmental impact, and maximizes crop yields.",
      caption: "Precision farming technology helps optimize resource use and reduce environmental impact",
      p4: "Cover cropping is another essential practice that involves planting specific crops to cover the soil during off-seasons. These crops prevent soil erosion, improve soil fertility, and provide habitat for beneficial insects. Popular cover crops include clover, rye grass, and buckwheat.",
      s2: "The Role of Technology",
      p5: "Modern technology plays a crucial role in sustainable agriculture. Drone technology allows farmers to monitor crop health, identify pest problems early, and apply treatments precisely where needed. IoT sensors can track soil moisture, temperature, and nutrient levels in real-time, enabling farmers to make data-driven decisions.",
      p6: "Artificial intelligence and machine learning are also transforming agriculture by predicting weather patterns, optimizing irrigation schedules, and identifying the best planting strategies for specific conditions. These technologies help farmers reduce resource consumption while maintaining or increasing productivity.",
      s3: "Looking Forward",
      p7: "The future of sustainable agriculture looks promising, with continued innovations in biotechnology, renewable energy integration, and sustainable pest management. As consumers become more environmentally conscious, the demand for sustainably produced food continues to grow, creating economic incentives for farmers to adopt these practices.",
      p8: "By embracing sustainable agriculture practices, farmers can contribute to a healthier planet while building resilient, profitable farming operations. The key is to start with small changes and gradually implement more comprehensive sustainable practices as knowledge and resources allow."
    },

    organic: {
      hero: "https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=1600&q=80",
      authorAvatar: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=300&q=80",
      inlineImage: "https://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=1200&q=80",
      author: "Emma Thompson",
      date: "April 2, 2024",
      readTime: "6 min read",
      lead: "Healthy crops start with balanced ecosystems. Organic pest control helps farmers protect plants while reducing the impact of synthetic chemicals on soil, water, and biodiversity.",
      title: "Organic Pest Control: Natural Solutions for Healthy Crops",
      p1: "Organic pest control focuses on preventing and managing pests using natural materials and ecological strategies. Rather than depending heavily on synthetic pesticides, farmers use biological agents, plant-based sprays, and habitat management to maintain crop health.",
      p2: "This approach supports beneficial insects such as ladybugs, lacewings, and parasitic wasps, which naturally reduce harmful pest populations. By creating a more balanced ecosystem, farmers can lower pest pressure over time.",
      quote: "Healthy crops begin with healthy ecosystems. Organic pest control protects both the harvest and the life around it.",
      quoteAuthor: "- Emma Thompson, Crop Specialist",
      s1: "Effective Organic Methods",
      p3: "Common organic pest control methods include neem oil, insecticidal soap, sticky traps, crop rotation, and companion planting. These techniques work best when combined in a well-planned farm management system.",
      caption: "Organic farming methods help reduce pest damage while supporting environmental balance",
      p4: "Farmers also monitor pest populations regularly so they can act early before infestations become severe. Prevention remains one of the most important principles in organic farming.",
      s2: "Why It Matters",
      p5: "Reducing chemical use can help preserve pollinator populations, protect soil organisms, and lower contamination risks for nearby water systems. These benefits make organic pest control valuable beyond the farm itself.",
      p6: "Consumers are also increasingly interested in produce grown with safer and more sustainable methods, which creates stronger market opportunities for farms using organic practices.",
      s3: "A Smarter Long-Term Approach",
      p7: "Although organic pest control may require more observation and planning, it can build stronger resilience into farming systems over the long term.",
      p8: "When farmers understand pest lifecycles and ecosystem relationships, they can create healthier fields that are naturally less vulnerable to severe outbreaks."
    },

    irrigation: {
      hero: "https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80",
      authorAvatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80",
      inlineImage: "https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1200&q=80",
      author: "James Wilson",
      date: "April 10, 2024",
      readTime: "7 min read",
      lead: "Water is one of agriculture’s most valuable resources. Smart irrigation systems help farmers apply water more precisely, improving crop performance while reducing waste.",
      title: "Smart Irrigation: Maximizing Water Efficiency",
      p1: "Smart irrigation uses technology such as soil moisture sensors, weather forecasting tools, and automated controllers to determine when and how much water crops need.",
      p2: "Instead of applying water on a fixed schedule, these systems adjust irrigation based on real field conditions. This reduces overwatering, lowers costs, and improves overall farm efficiency.",
      quote: "The future of farming depends on how wisely we use every drop of water.",
      quoteAuthor: "- James Wilson, Irrigation Analyst",
      s1: "How Smart Systems Work",
      p3: "Sensors placed in the field can monitor soil conditions in real time. When connected to automated irrigation systems, farmers can deliver water only where and when it is needed most.",
      caption: "Smart irrigation technology helps optimize water distribution and crop health",
      p4: "Some systems also integrate local weather data to avoid unnecessary watering before rainfall, helping conserve resources and reduce runoff.",
      s2: "Benefits for Farmers",
      p5: "Efficient irrigation can improve yields, reduce disease risk caused by excessive moisture, and save both water and energy. These benefits are especially important in regions facing water scarcity.",
      p6: "By using accurate field data, farmers can make better decisions and improve the reliability of crop production throughout the season.",
      s3: "The Future of Water Management",
      p7: "As climate variability increases, smart irrigation will become even more important for maintaining sustainable agricultural productivity.",
      p8: "Investing in efficient water systems today can help farms remain resilient, profitable, and environmentally responsible in the years ahead."
    },

    rotation: {
      hero: "https://images.unsplash.com/photo-1471193945509-9ad0617afabf?auto=format&fit=crop&w=1600&q=80",
      authorAvatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80",
      inlineImage: "https://images.unsplash.com/photo-1471193945509-9ad0617afabf?auto=format&fit=crop&w=1200&q=80",
      author: "Maria Garcia",
      date: "April 15, 2024",
      readTime: "5 min read",
      lead: "Crop rotation is a simple but powerful farming strategy that improves soil quality, reduces pest cycles, and supports healthier harvests over time.",
      title: "Crop Rotation Strategies for Soil Health",
      p1: "Crop rotation involves planting different types of crops in sequence across the same area over multiple seasons. Each crop interacts with the soil differently, which helps maintain balance in nutrient use.",
      p2: "For example, legumes can help increase nitrogen in the soil, while deep-rooted crops may improve soil structure. Rotating plant families also reduces the buildup of pests and diseases linked to specific crops.",
      quote: "Healthy soil is not built in one season. It is built through thoughtful cycles and long-term care.",
      quoteAuthor: "- Maria Garcia, Soil Researcher",
      s1: "Why Rotation Works",
      p3: "By changing what is grown in each field, farmers reduce soil exhaustion and interrupt the lifecycle of harmful organisms. This lowers dependency on external chemical inputs and supports a more natural balance.",
      caption: "Crop rotation helps maintain soil fertility and reduce long-term pest pressure",
      p4: "A well-designed rotation plan can also improve weed control and make better use of seasonal growing conditions.",
      s2: "Planning an Effective Sequence",
      p5: "Successful rotation requires understanding crop families, nutrient demands, and local environmental conditions. Farmers often alternate cereals, legumes, and root crops to achieve the best results.",
      p6: "The strategy becomes even stronger when combined with cover crops and conservation tillage practices.",
      s3: "Building Soil for the Future",
      p7: "Healthy soil is one of the most important foundations of sustainable agriculture, and crop rotation is one of the most practical ways to protect it.",
      p8: "Over time, thoughtful rotation can improve productivity, resilience, and the long-term sustainability of the entire farming system."
    }
  };

  function setHeroBackground(imageUrl) {
    articleHero.style.background = `
      linear-gradient(rgba(18, 43, 27, 0.30), rgba(18, 43, 27, 0.42)),
      url("${imageUrl}") center center / cover no-repeat
    `;
  }

  function renderArticle(data) {
    authorAvatar.src = data.authorAvatar;
    articleAuthor.textContent = data.author;
    articleDate.textContent = data.date;
    articleReadTime.textContent = data.readTime;
    articleLead.textContent = data.lead;
    articleTitle.textContent = data.title;
    paragraph1.textContent = data.p1;
    paragraph2.textContent = data.p2;
    articleQuote.textContent = data.quote;
    articleQuoteAuthor.textContent = data.quoteAuthor;
    subtitle1.textContent = data.s1;
    paragraph3.textContent = data.p3;
    articleInlineImage.src = data.inlineImage;
    articleImageCaption.textContent = data.caption;
    paragraph4.textContent = data.p4;
    subtitle2.textContent = data.s2;
    paragraph5.textContent = data.p5;
    paragraph6.textContent = data.p6;
    subtitle3.textContent = data.s3;
    paragraph7.textContent = data.p7;
    paragraph8.textContent = data.p8;

    setHeroBackground(data.hero);

    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }

  if (menuToggle) {
    menuToggle.addEventListener("click", function () {
      sidebar.classList.toggle("collapsed");
    });
  }

  if (bookmarkBtn) {
    bookmarkBtn.addEventListener("click", function () {
      bookmarkBtn.classList.toggle("saved");
    });
  }

  recommendedCards.forEach((card) => {
    card.addEventListener("click", function () {
      const articleKey = this.getAttribute("data-article");

      if (articleKey === "organic") {
        renderArticle(articles.organic);
      } else if (articleKey === "irrigation") {
        renderArticle(articles.irrigation);
      } else if (articleKey === "rotation") {
        renderArticle(articles.rotation);
      }
    });
  });

  renderArticle(articles.sustainable);
});