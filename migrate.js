import { Sequelize } from "sequelize";
import { sequelize } from "./models/db.js";

import { Patient } from "./models/Patient.js";
import { Doctor } from "./models/Doctor.js";
import { Appointment } from "./models/Appointment.js";
import { Prescription } from "./models/Prescription.js";
import { Payment } from "./models/Payment.js";

import inquirer from "inquirer";

const rootSequelize = new Sequelize(
    "mysql://root:@localhost:3306/"
);

const { createDb } = await inquirer.prompt([
    {
        type: "confirm",
        name: "createDb",
        message: "Create clinicdb database?",
        default: true
    }
]);

if (createDb) {
    await rootSequelize.query(
        "CREATE DATABASE IF NOT EXISTS clinicdb;"
    );

    console.log("✅ Database created");
}

try {

    await sequelize.authenticate();

    console.log("✅ Connected to MySQL database!");

    await sequelize.sync({ force: true });

    console.log("✅ All clinic tables created!");

} catch (err) {

    console.error("❌ Migration failed:", err);

} finally {

    process.exit();

}