<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sproutly - Saved Articles</title>
</head>

<body>

  <!-- Top Navigation -->
  <header>
    <div>
      <div>
        <span>eco</span>
      </div>
      <h2>Sproutly</h2>
    </div>

    <nav>
      <a href="#">Dashboard</a>
      <a href="#">Library</a>
      <a href="#">Analytics</a>
    </nav>

    <div>
      <button type="button">notifications</button>
      <button type="button">settings</button>
      <img
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVgiC40bkNKmlM8BU-xYoujVGfmqf69tcFBEIe5cLN83Vqe6imLBHDbJMvz8HBQ_ELaegPHxqYz63n45DZBZoXOVvtXydZZddB2_pIpsURXR2gQRnNrP6LBxmUSuqML4ltcn9VzqMfwUhXQM-VcRdqfq2WJULXkfzjZMTI_Hq5w67oTDzyF9EbnJ3eeW3nCQgafTFH70XsiG8HO8fD812_dNpLe753dsay_UcJOOLmq-H2i0VSWama3IaZfM7FIPH5-2zXwl0RKEk"
        alt="User profile avatar portrait"
      />
    </div>
  </header>

  <main>

    <!-- Header Section -->
    <section>
      <div>
        <h1>Saved Articles</h1>
        <p>Manage your curated library of agricultural insights.</p>
      </div>

      <div>
        <label for="search">Search</label>
        <input id="search" type="text" placeholder="Search saved articles..." />
        <button type="button">Filter</button>
      </div>
    </section>

    <!-- Main Content: Articles Table -->
    <section>
      <h2>Saved Articles Table</h2>

      <table>
        <thead>
          <tr>
            <th>Article</th>
            <th>Category</th>
            <th>Date Saved</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>

          <!-- Row 1 -->
          <tr>
            <td>
              <img
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBSlnAB4HqeWgjwBrTYqqEg6W5ctxZVxCs9Wuh1_MX3Oiqg7VWs9no55pybUHzlGErDY0_ZrN-fNCgoFmU5jJesmwwPl_cSZPndabRPnVRELiyfFaokDtxVTHEsQ8PbSebzzuK3lYN0I671yGiyLtr_m8qxQRqrHD810cinF-O3t1PAsIVJvGJ1foxH-Kl0ZUoAiH8fgrGYdBeroOWrHklSskcOAb7AWFpJzHa6yaPDeGZUz9FqB1-cm78tMyeOHoIitlGCmwOVBuM"
                alt="Vibrant green crop field overhead view"
              />
              <div>
                <p>Optimizing Soil Health for Organic Farming</p>
                <p>Discover the latest techniques for maintaining high yields without synthetic fertilizers...</p>
              </div>
            </td>
            <td>Soil Science</td>
            <td>Oct 25, 2023</td>
            <td>
              <button type="button">View</button>
              <button type="button">Delete</button>
            </td>
          </tr>

          <!-- Row 2 -->
          <tr>
            <td>
              <img
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTdNl0IxhbDF6rf1wOau4vQ0hjjgy4B2dbJ1FrRYpVSybTh0q051O_6ttnE9f0AwHA659hiHQjoiWw8tWIrE6DNYa-jypjJbRCwigUH_K_JvEH-ImXwwOFX4A4_6aTQvxcj75B3X0FjNsqc46IPDgZl9zfVYJW4VRlE1N5XXsqSj26P9funOcnZBXl7b2uxtjjVcbs2bDT55nK8Ai3dz20Bw7RXloFf48nf-y3-v5Az_NoF87vR-QXR2MtBySIzNABqsetiyys1QQ"
                alt="Automated irrigation system in farm field"
              />
              <div>
                <p>Smart Irrigation: The Future of Water</p>
                <p>How IoT sensors are reducing water waste by 40% in large-scale operations...</p>
              </div>
            </td>
            <td>Technology</td>
            <td>Oct 22, 2023</td>
            <td>
              <button type="button">View</button>
              <button type="button">Delete</button>
            </td>
          </tr>

          <!-- Row 3 -->
          <tr>
            <td>
              <img
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuC_sUphrufVcPiBBR6V2by69hp0ktt-vtlw-ERFm-DMkGvxfHeS94xAhUwFXoL1i8RH8ACkag6KqCQoQHlNL6QPzJkrzr_LPFmnpY2JjU7wJyp5R6UPXV-Whi1W9wajoFcXTbPo5ecXmSOdPf_yF4sDLiH-aWLg159-8KPK7Myzr_rfLCBZdA_DSLZSmPLhfa32lFaLPm6ovLW5Z1YjFrtN-BmRsjX4U8M2UaOa4tNvoHTTITuw80vhetQapo2GiIMHXesENKr0zdE"
                alt="Healthy vegetable sprouts growing in soil"
              />
              <div>
                <p>Advanced Crop Rotation Strategies</p>
                <p>Maximizing nutrient recovery through strategic seasonal planning...</p>
              </div>
            </td>
            <td>Crop Mgmt</td>
            <td>Oct 18, 2023</td>
            <td>
              <button type="button">View</button>
              <button type="button">Delete</button>
            </td>
          </tr>

        </tbody>
      </table>

      <!-- Pagination -->
      <div>
        <button type="button">Previous</button>
        <button type="button">1</button>
        <button type="button">2</button>
        <button type="button">3</button>
        <button type="button">Next</button>
      </div>
    </section>

    <!-- Summary Stats -->
    <section>
      <h2>Summary</h2>

      <div>
        <p>Total Saved</p>
        <p>124</p>
      </div>

      <div>
        <p>Saved This Week</p>
        <p>+12</p>
      </div>

      <div>
        <p>Top Category</p>
        <p>Soil Health</p>
      </div>
    </section>

  </main>

  <footer>
    <p>© 2023 Sproutly Agricultural Insights. All rights reserved.</p>
  </footer>

</body>
</html>