import Student from "./models/Student.js";
import BankAccount from "./models/BankAccount.js";

const mhs = new Student("Jakka", 21, "241110092", "Teknik Informatika");
mhs.greet();
mhs.study();

const rekeningMhs = new BankAccount("Jakka");
rekeningMhs.deposit(1000000);
rekeningMhs.withdraw(500000);

document.getElementById("output").innerHTML = `
    <h2>Data Mahasiswa</h2>
    <p><strong>Nama:</strong> ${mhs.name}</p>
    <p><strong>NIM:</strong> ${mhs.nim}</p>
    <p><strong>Jurusan:</strong> ${mhs.major}</p>
    <p><strong>Saldo:</strong>
    Rp${rekeningMhs.getBalance().toLocaleString("id-ID", { minimumFractionDigits: 2 })}</p>
`;
