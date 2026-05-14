# Content Personalization Algorithm

> **Status: Designed & Documented — Not yet integrated into the web prototype.**
> The algorithm is ready for implementation. Integration with the live platform is a planned next step.

---

## Overview

After the EEG classifier identifies the user's intelligence type, this algorithm scores and ranks educational content by compatibility with the user's learning profile.

```
EEG Classifier Output
        ↓
Intelligence Type (e.g. Visual-Spatial)
        ↓
Content Personalization Algorithm
        ↓
Ranked Feed:
  → Best For You   (match score ≥ 0.3)
  → Needs Transform (match score < 0.3)
```

---

## Intelligence → Learning Style Mapping

Each intelligence type maps to a set of content keywords that reflect how that type of learner absorbs information best.

```python
INTELLIGENCE_PROFILES = {
    'Visual':      ['visual', 'diagram', 'design', 'video', 'infographic', 'chart'],
    'Linguistic':  ['reading', 'writing', 'language', 'lecture', 'text', 'article'],
    'Logical':     ['math', 'programming', 'logic', 'problem', 'analysis', 'code'],
    'Musical':     ['audio', 'rhythm', 'sound', 'music', 'podcast', 'pattern'],
    'Kinesthetic': ['hands-on', 'practice', 'build', 'project', 'lab', 'exercise']
}
```

---

## Course Schema

Every course in the system carries a set of tags that describe its content format and delivery style.

```python
COURSES = [
    {
        'title':    'UX Design Professional Certificate',
        'platform': 'Coursera',
        'tags':     ['visual', 'design', 'diagram'],
        'url':      'https://coursera.org/...'
    },
    {
        'title':    'Python Full Course for Beginners',
        'platform': 'YouTube',
        'tags':     ['programming', 'code', 'logic'],
        'url':      'https://youtube.com/...'
    },
    {
        'title':    'Arabic NLP Fundamentals',
        'platform': 'Satr',
        'tags':     ['text', 'language', 'writing'],
        'url':      'https://satr.codes/...'
    }
]
```

---

## Scoring Function

```python
def score_course(course: dict, intelligence_type: str) -> float:
    """
    Returns a compatibility score between 0.0 and 1.0.
    Score = (matching tags) / (total profile tags)
    """
    profile = INTELLIGENCE_PROFILES.get(intelligence_type, [])
    if not profile:
        return 0.0
    matches = len(set(course['tags']) & set(profile))
    return round(matches / len(profile), 2)


def get_personalized_feed(intelligence_type: str) -> list:
    """
    Returns all courses sorted by compatibility score (descending).
    Each course is labeled 'Best For You' or 'Needs Transform'.
    """
    results = []
    for course in COURSES:
        score = score_course(course, intelligence_type)
        results.append({
            **course,
            'score': score,
            'label': 'Best For You' if score >= 0.3 else 'Needs Transform'
        })
    return sorted(results, key=lambda x: x['score'], reverse=True)
```

---

## Example Output

For a **Visual-Spatial** user:

```
Title                              Platform   Score   Label
─────────────────────────────────────────────────────────────
UX Design Professional Certificate Coursera   0.50    Best For You
Python Full Course for Beginners   YouTube    0.17    Needs Transform
Arabic NLP Fundamentals            Satr       0.00    Needs Transform
```

---

## Scalability

The algorithm is designed to be source-agnostic.
Any content source can feed into the same scoring logic:

```
YouTube API   ─┐
Coursera API  ─┼──► tag extraction ──► score_course() ──► ranked feed
Satr API      ─┘
Scraped data  ─┘
```

Only the tags need to be extracted or assigned — the core algorithm remains unchanged.

---

## Planned Integration

| Step | Description | Status |
|---|---|---|
| 1 | Algorithm design & documentation | ✅ Done |
| 2 | Add tags to existing hardcoded courses | ⏳ Pending |
| 3 | Replace static course labels in courses.html | ⏳ Pending |
| 4 | Connect to EEG classifier output | ⏳ Pending |
| 5 | YouTube / Coursera API integration | 🔮 Future |
| 6 | GPT/Gemini for dynamic tag extraction | 🔮 Future |
