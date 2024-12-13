/**
 * Fungsi untuk menampilkan hasil download
 * @param {string} result - Nama file yang didownload
 */
const showDownload = (result) => {
    console.log("Download selesai");
    console.log(`Hasil Download: ${result}`);
  };
  
  /**
   * Fungsi untuk download file menggunakan Promise
   * @returns {Promise<string>} - Promise yang menyelesaikan nama file yang didownload
   */
  const download = () => {
    return new Promise((resolve) => {
      setTimeout(() => {
        const result = "windows-10.exe";
        resolve(result);
      }, 3000);
    });
  };
  
  // Menggunakan async/await untuk menjalankan fungsi download
  const initiateDownload = async () => {
    console.log("Memulai download...");
    try {
      const result = await download();
      showDownload(result);
    } catch (error) {
      console.error("Terjadi kesalahan saat download:", error);
    }
  };
  
  // Memulai proses
  initiateDownload();  