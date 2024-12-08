function showSection(sectionId) {
    const sections = document.querySelectorAll('.tab-content');
    const tabs = document.querySelectorAll('.tab-link');
  
    sections.forEach(section => {
      section.classList.remove('active');
    });
  
    tabs.forEach(tab => {
      tab.classList.remove('active');
    });
  
    document.getElementById(sectionId).classList.add('active');
    document.querySelector(`button[onclick="showSection('${sectionId}')"]`).classList.add('active');
  }
  
  // Show the PS5 games section by default
  document.getElementById('ps5-games').classList.add('active');
  document.querySelector(`button[onclick="showSection('ps5-games')"]`).classList.add('active');
  