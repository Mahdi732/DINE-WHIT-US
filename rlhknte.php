let categorySelect = document.getElementById("categorySelect");
let vehiculecontainer = document.querySelector(".vehiculecontainer");

categorySelect.addEventListener('change', () => {
    let categorie = categorySelect.value;
    let conn = new XMLHttpRequest();
    conn.open('POST', '../classes/filter_vehiculs.php');
conn.send(`categorie_sel=${categorie}`);
    conn.onload = () => {
        if (conn.status === 200) {
            let vehicles = JSON.parse(conn.responseText);
            vehiculecontainer.innerHTML = "";

            if (vehicles.length > 0) {
                vehicles.forEach(v => {
                    vehiculecontainer.innerHTML += `
                    <div class="card-hover-effect">
                        <div class="gradient-border">
                            <div class="bg-black rounded-xl overflow-hidden">
                                <div class="relative">
                                    <img 
                                        src="${v.image_url}" 
                                        alt="${v.model}" 
                                        class="w-full h-64 object-cover"
                                    >
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 bg-[#FF6B6B]/20 text-[#FF6B6B] rounded-full text-sm backdrop-blur-xl">
                                            Supercar
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6 space-y-4">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-xl font-bold text-white">${v.model}</h3>
                                            <p class="text-gray-400">${v.Marque}</p>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span class="text-white font-medium">4.9</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B6B] to-[#4ECDC4]">${v.price}</span>
                                            <span class="text-gray-400">/jour</span>
                                        </div>
                                        <button class="px-6 py-2 bg-gradient-to-r from-[#FF6B6B] to-[#4ECDC4] rounded-full text-white font-medium hover:opacity-90 transition-opacity duration-300">
                                            Réserver
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
            } else {
                vehiculecontainer.innerHTML = `<p class="text-white">Aucun véhicule trouvé.</p>`;
            }
        }
    };
});
///////////////////////////