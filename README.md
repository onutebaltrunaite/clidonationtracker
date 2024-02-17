# CLI Donation Tracker

## Introduction

The CLI Donation Tracker is a command-line interface application designed to manage and track charitable donations. It provides a comprehensive logging system for donations made to various charities.

Users are equipped with full CRUD (Create, Read, Update, Delete) capabilities for managing charities within the application. Furthermore, users can assign donations to specific charities, enhancing the tracking and organization of charitable contributions.

## Requirements

The application has the following functionality:
• View charities
• Add charity
• Edit charity
• Delete charity
• Add donation
• Import charities in CSV format.

## Architecture

The application follows a folder structure:

cliDonationTracker
│   README.md
│   run.php
│
├───resources
│       test.csv
│
└───src
    ├───cli
    │       Menu.php
    │
    ├───dao
    │       CharityDAO.php
    │       DonationDAO.php
    │
    ├───data
    │       CsvImport.php
    │       DB.php
    │       TestData.php
    │       
    ├───model
    │       Charity.php
    │       Donation.php
    │
    └───validations
            Validations.php


## Prerequisites

Before you begin, ensure you have met the following requirements:

1. You have installed Git. 
2. You have a working installation of PHP.
3. You have MariaDB installed and running on your machine.

## How to run the application

1. Enable the `msqli` extension on your local PhP installation. In order to do this,
you have to locate the php.ini file of your local php installation and uncomment or write the `extension=mysqli` line under the Dynamic Extensions section.
2. Clone the project onto your local machine using the command:
`git clone `
3. Open the cloned repository root folder (clidonationtracker) with your preferred IDE and locate the src/data/DB.php class. Set the `$userName` and `$password` fields to corresponds to the credentials of a user with sufficient privileges to create a database schema on your local MariaDB.
4. Open a terminal and use the cd command to navigate into the root folder cloned repository (clidonationtracker)
6. Run the application using the command:
`php run.php`
