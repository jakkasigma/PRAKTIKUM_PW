export default class BankAccount {
    #balance = 0;

    constructor(owner) {
        this.owner = owner;
   }

    deposit(amount) {
        if (amount > 0) {
            this.#balance += amount;
            console.log(`${this.owner} deposited ${amount}`);
        }
    }

    withdraw(amount) {
        if (amount > 0 && amount <= this.#balance) {
            this.#balance -= amount;
            console.log(`${this.owner} withdrew ${amount}. New balance: ${this.#balance}`);
            console.log(`${this.owner} menarik rp${amount}`);
        } else {
            console.log("saldo tidak cukup");
        }
    }

    getBalance() {
        return this.#balance;
    }

}