# NeuroGift — System Architecture

## Overview

NeuroGift operates as a 5-stage pipeline connecting a physical EEG device concept to a web-based personalized learning platform.

---

## Full System Pipeline

```
┌─────────────────────────────────────────────────────────────┐
│                    NeuroGift System                         │
│                                                             │
│  ┌──────────┐    ┌──────────┐    ┌──────────┐             │
│  │  EEG     │───▶│  Signal  │───▶│  AI      │             │
│  │  Device  │    │  Process │    │  Engine  │             │
│  │(Concept) │    │          │    │          │             │
│  └──────────┘    └──────────┘    └────┬─────┘             │
│                                       │                     │
│                              Intelligence Type              │
│                    ┌──────────────────┼──────────┐         │
│                    ▼                  ▼           ▼         │
│              ┌──────────┐      ┌──────────┐  ┌────────┐   │
│              │  Course  │      │    AI    │  │ User   │   │
│              │  Engine  │      │Transform │  │Profile │   │
│              └──────────┘      └──────────┘  └────────┘   │
└─────────────────────────────────────────────────────────────┘
```

---

## Stage 1: EEG Signal Capture (Device Concept)

**Purpose:** Capture brainwave activity during a standardized cognitive task.

**Device:** Non-invasive EEG headset — NeuroGift-X1 (concept)
- Electrode placements: Fp1, Fp2, F3, F4, C3, C4 (frontal + central)
- Sampling rate: Standard EEG rates (256–512 Hz)
- Connection: Wireless (Bluetooth)
- Session duration: ~2 minutes

**Assessment task:** 3 Visual-Spatial cognitive questions designed to activate distinct neural patterns across different intelligence types.

> Note: The physical device is a design concept. The system is built and validated using existing public EEG datasets (EDF format).

---

## Stage 2: Signal Processing

**Input:** Raw EEG signal (time series per electrode)
**Output:** Feature vector per frequency band per electrode

**Processing steps:**
1. Bandpass filtering per frequency band
2. Feature extraction:
   - Alpha (8–13 Hz): Relaxation, attention
   - Beta (13–30 Hz): Active thinking, focus
   - Theta (4–8 Hz): Memory, creativity
   - Gamma (30+ Hz): High-level cognition
3. Normalization and noise reduction
4. Output: Structured CSV row (same format as training data)

---

## Stage 3: AI Classification Engine

**Model:** Random Forest Classifier
**Input:** EEG feature vector
**Output:** Intelligence type + confidence score

**Intelligence Types:**
| Type | Neural Signature |
|---|---|
| Visual-Spatial | High Alpha in occipital regions |
| Linguistic | High Beta in left temporal |
| Logical-Mathematical | High Gamma in frontal |
| Musical | High Theta with rhythmic patterns |
| Kinesthetic | High Beta in motor cortex regions |

**Model specs:**
- Algorithm: Random Forest (100 trees)
- Training data: 2,803,517 samples across 5 classes
- Accuracy: 99.99%
- Saved as: `NeuroGift_Final_Model.pkl`

---

## Stage 4: Course Recommendation Engine

**Input:** Intelligence type from AI Engine
**Process:**
1. Query course database tagged by learning style compatibility
2. Rank by match score with user's intelligence type
3. Flag incompatible courses as "Needs Transform"

**Platforms integrated (demo):**
- YouTube (Elzero Web School, etc.)
- Coursera (Google, etc.)
- Satr.codes

**Filters:**
- All / Best For You / Needs Transform

---

## Stage 5: AI Transform Engine

**Trigger:** User clicks "Transform" on a "Needs Transform" course
**Input:** Course content + user intelligence type
**Output:** Reformatted learning material

**Transformation formats for Visual learners:**
- Concept Map (key concepts + relationships)
- Keywords list
- Visual Outputs (mindmaps, diagrams, flowcharts)
- Flashcards (Q&A pairs)

**Technical implementation:** Client-side AI generation (demo version uses static demonstration content)

---

## Web Application Stack

**Frontend:**
- HTML5 / CSS3 / JavaScript (all inline — single-file pages)
- No external frameworks (pure JS)
- Responsive design, futuristic dark UI

**Backend:**
- PHP 8.x
- MySQL database (neurogift DB)
- RESTful API endpoints:
  - `POST /api/signup.php` — User registration
  - `POST /api/login.php` — Authentication
  - `GET /api/me.php` — Session user data
  - `POST /api/save_analysis.php` — Save EEG analysis result
  - `POST /api/logout.php` — End session

**Database:**
```sql
users (id, full_name, email, password_hash, has_analysis, last_result, created_at)
analyses (id, user_id, result, created_at)
```

**Hosting:** Infinity Free (demo deployment)
**Live URL:** neurogift-demo.free.nf

---

## User Journey

```
Landing Page (index.html)
        ↓
Sign Up / Login
        ↓
Onboarding (onboarding.html)
        ↓
Device Connect — EEG pairing simulation (device-connect.html)
        ↓
Assessment — 3 cognitive questions + live EEG display (assessment.html)
        ↓
Analyzing — Processing animation (analyzing.html)
        ↓
Dashboard — Brain activity + intelligence results (dashboard.html)
        ↓
Courses — Personalized feed (courses.html)
        ↓
[Optional] AI Transform (full-courses.html)
        ↓
Profile — Saved results (profile.html)
```
